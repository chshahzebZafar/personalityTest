class MonitoringSystem {
  constructor() {
    this.stream = null;
    this.screenStream = null;
    this.isMonitoring = false;
    this.monitoringInterval = null;
    this.isScreenShared = false;
    this.onSecurityViolation = null; // Callback for security violations
  }

  async initializeCamera() {
    try {
      // Only request screen sharing if not already shared
      if (!this.isScreenShared || !this.screenStream) {
        await this.setupScreenCapture();
      }
      // Then setup camera
      await this.setupCamera();

      // Don't start monitoring yet - we'll do that after fullscreen
      this.showAlert("success", "Camera and screen access granted");
    } catch (error) {
        console.error("Error initializing monitoring:", error);

    if (error.name === "NotAllowedError" || error.name === "PermissionDeniedError") {
      this.showAlert("danger", "Camera access was denied. Please allow camera access to proceed.");
    } else {
      this.showAlert("danger", "Camera and screen access are required for this test.");
    }

    throw new Error("Camera and screen access are required for this test");
    
    }
  }

  async setupCamera() {
    this.stream = await navigator.mediaDevices.getUserMedia({
      video: true,
      audio: false,
    });

    const video = document.getElementById("webcam");
    video.srcObject = this.stream;
    await video.play();

    // Add track ended listener for camera
    this.stream.getVideoTracks()[0].addEventListener("ended", () => {
      if (this.onSecurityViolation) {
        this.onSecurityViolation("Camera access was stopped");
      }
    });
  }

  async setupScreenCapture() {
    if (this.isScreenShared && this.screenStream) {
      return; // Skip if already sharing
    }

    this.screenStream = await navigator.mediaDevices.getDisplayMedia({
      video: {
        cursor: "always",
        displaySurface: "monitor", // Restrict to entire screen only
      },
      audio: false,
    });

    // Add track ended listener to handle when user stops sharing
    this.screenStream.getVideoTracks()[0].addEventListener("ended", () => {
      this.isScreenShared = false;
      this.screenStream = null;
      // Trigger security violation when screen sharing stops
      if (this.onSecurityViolation) {
        this.onSecurityViolation("Screen sharing was stopped");
      }
    });

    this.isScreenShared = true;
  }

  showAlert(type, message) {
    const alertDiv = document.createElement("div");
    alertDiv.className = `alert alert-${type}`;
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);

    setTimeout(() => {
      alertDiv.remove();
    }, 5000);
  }

  startMonitoring() {
    if (!this.stream || !this.screenStream) {
      throw new Error(
        "Camera and screen must be initialized before monitoring"
      );
    }

    this.isMonitoring = true;
    this.monitoringInterval = setInterval(() => {
      this.captureAndSendSnapshots();
    }, 10000); // Take snapshots every 10 seconds
  }

  async captureAndSendSnapshots() {
    try {
      // Capture camera snapshot
      const cameraSnapshot = this.captureCamera();

      // Capture screen snapshot
      let screenSnapshot = null;
      try {
        screenSnapshot = await this.captureScreen();
      } catch (error) {
        console.error("Error capturing screen:", error);
        screenSnapshot = ""; // Send empty string if screen capture fails
      }

      // Send both snapshots to server
      await this.sendToServer({
        camera: cameraSnapshot,
        screen: screenSnapshot,
          quiz_id:quizId,
        timestamp: new Date().toISOString(),
      });
    } catch (error) {
      console.error("Error capturing snapshots:", error);
    }
  }

  captureCamera() {
    const video = document.getElementById("webcam");
    const canvas = document.getElementById("canvas");
    const context = canvas.getContext("2d");

    // Set canvas size to match video dimensions
    canvas.width = video.videoWidth;
    canvas.height = video.videoHeight;

    // Draw video frame to canvas
    context.drawImage(video, 0, 0, canvas.width, canvas.height);

    // Get image data as base64 string
    return canvas.toDataURL("image/jpeg", 0.8);
  }

  async captureScreen() {
    try {
      const videoTrack = this.screenStream.getVideoTracks()[0];
      const imageCapture = new ImageCapture(videoTrack);
      const bitmap = await imageCapture.grabFrame();

      const canvas = document.getElementById("canvas");
      const context = canvas.getContext("2d");

      canvas.width = bitmap.width;
      canvas.height = bitmap.height;
      context.drawImage(bitmap, 0, 0);

      return canvas.toDataURL("image/jpeg", 0.8);
    } catch (error) {
      console.error("Error in screen capture:", error);
      throw error;
    }
  }

  async sendToServer(data) {
    try {
      await fetch(routeUserTestMonitor, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
          "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute('content') // CSRF ٹوکن شامل کریں
        },
        body: JSON.stringify(data),
      });
    } catch (error) {
      console.error("Error sending snapshots to server:", error);
    }
  }

  stopMonitoring() {
    if (this.isMonitoring) {
      clearInterval(this.monitoringInterval);
      this.isMonitoring = false;

      if (this.stream) {
        this.stream.getTracks().forEach((track) => track.stop());
        this.stream = null;
      }
      if (this.screenStream) {
        this.screenStream.getTracks().forEach((track) => track.stop());
        this.screenStream = null;
        this.isScreenShared = false;
      }
    }
  }
}

export default MonitoringSystem;
