import MonitoringSystem from "./monitoring.js?v=0.1";

class SecureTestEnvironment {
  constructor() {
    this.monitoring = new MonitoringSystem();
    this.isFullscreen = false;
    this.violations = 0;
    this.isTerminated = false;
    this.tabSwitchCount = 0;
    this.setupInitialEventListeners();

    // Setup security violation handler
    this.monitoring.onSecurityViolation = (reason) =>
      this.terminateTest(reason);

    this.setupCancelButton();
  }
    startTimer(durationInSeconds) {
        let remaining = durationInSeconds;
        const timerDisplay = document.getElementById("timer");

        const updateTimer = () => {
            const minutes = String(Math.floor((remaining % 3600) / 60)).padStart(2, '0');
            const seconds = String(remaining % 60).padStart(2, '0');
            timerDisplay.textContent = `${minutes}:${seconds}`;

            if (remaining <= 0) {
                clearInterval(this.countdownInterval);
                timerDisplay.textContent = "Time's up!";
                this.terminateTest("Time finished"); // Optional: Auto terminate test
            }

            remaining--;
        };

        updateTimer();
        this.countdownInterval = setInterval(updateTimer, 1000);
    }

   setupInitialEventListeners() {
    const startButton = document.getElementById("start-test");

    startButton.addEventListener("click", async () => {
        try {
            // ✅ MUST be inside user click
            await this.requestFullscreen();

            // After fullscreen success → start test
            await this.startSecureTest();

        } catch (error) {
            console.error("Fullscreen error:", error);
            this.showAlert("danger", "Fullscreen permission is required to start the test.");
        }
    });
}

   async startSecureTest() {
    try {
        // Final safety check
        if (!document.fullscreenElement) {
            this.showAlert("danger", "Fullscreen is required to continue.");
            return;
        }

        // Initialize secure environment
        await this.initializeSecureEnvironment();

        $('#instructionModal').modal('hide');
       
        this.startTimer(1200);

    } catch (error) {
        console.error("Initialization error:", error);
    }
}

  async initializeSecureEnvironment() {
    try {
      // Request fullscreen
      await this.requestFullscreen();

      // Show test container
      const startScreen = document.getElementById("instructionModal");
      const testContainer = document.getElementById("test-container");

      startScreen.style.display = "none";
      testContainer.style.display = "block";

      // Add visible class after a brief delay for smooth transition
      setTimeout(() => {
        testContainer.classList.add("visible");
      }, 100);
      // Setup event listeners
      this.setupEventListeners();
      // Setup copy/paste prevention
      this.disableCopyPaste();
    //   this.showAlert("success", "Test environment secured. You can begin now.");
      // Show cancel button after environment is secured
      const cancelButton = document.querySelector(".cancel-button");
      cancelButton.classList.add("visible");
    } catch (error) {
      console.error("Secure environment error:", error);
      throw new Error("Failed to initialize secure environment");
    }
  }
  setupEventListeners() {
    // Fullscreen change detection
    document.addEventListener("fullscreenchange", () =>
      this.handleFullscreenChange()
    );
    // Disable right-click
    document.addEventListener("contextmenu", (e) => e.preventDefault());
    // Disable keyboard shortcuts
    document.addEventListener("keydown", (e) => this.handleKeyPress(e));
    // Detect tab/window switching
    document.addEventListener("visibilitychange", () =>
      this.handleVisibilityChange()
    );
    // Detect window resize (possible minimize attempt)
    window.addEventListener("resize", () => this.handleResize());
  }

  showAlert(type, message,time=5000) {
    const alertDiv = document.createElement("div");
    alertDiv.className = `alert alert-${type}`;
    alertDiv.textContent = message;
    document.body.appendChild(alertDiv);

    setTimeout(() => {
      alertDiv.remove();
    }, time);
  }

    async requestFullscreen() {
    const docEl = document.documentElement;

    if (!document.fullscreenElement) {
        if (docEl.requestFullscreen) {
            await docEl.requestFullscreen();
        } else if (docEl.webkitRequestFullscreen) {
            await docEl.webkitRequestFullscreen();
        } else if (docEl.msRequestFullscreen) {
            await docEl.msRequestFullscreen();
        }
    }

    this.isFullscreen = true;
}

  handleFullscreenChange() {
    if (this.isTerminated) return;
    this.isFullscreen = !!document.fullscreenElement;

    if (!this.isFullscreen) {
      // Show confirmation before terminating
      this.showTerminationConfirmation();
      // If user cancels, request fullscreen again
      document.querySelector(".cancel-modal-button").onclick = async () => {
        document
          .getElementById("confirmation-modal")
          .classList.remove("visible");
        await this.requestFullscreen();
      };
    }
  }

  handleKeyPress(e) {
    if (this.isTerminated) return;
    // Prevent common keyboard shortcuts
    if (
      (e.ctrlKey && (e.key === "c" || e.key === "v" || e.key === "p")) || // Copy, Paste, Print
      (e.altKey && e.key === "Tab") || // Alt+Tab
      e.key === "F11" || // Fullscreen
      e.key === "PrintScreen" || // Screenshot
      e.key === "F12" // Inspect
    ) {
      e.preventDefault();
      this.showAlert(
        "warning",
        "Keyboard shortcuts are disabled during the test"
      );
    }
  }

  handleVisibilityChange() {
    if (this.isTerminated) return;

    if (document.hidden) {
      this.tabSwitchCount++;
  console.log(this.tabSwitchCount)
      if (this.tabSwitchCount === 1 || this.tabSwitchCount === 2) {
        this.showAlert(
          "warning",
          `Tab switching detected (${this.tabSwitchCount}/3). The test will terminate on the next attempt.`,
          10000
        );
      } else if (this.tabSwitchCount >= 3) {
        this.terminateTest("Tab switching detected multiple times");
      }
    }
  
  }

  handleResize() {
    if (this.isTerminated) return;
    if (!this.isFullscreen && window.outerHeight < window.screen.height) {
      this.terminateTest("Window was minimized");
    }
  }

  disableCopyPaste() {
    document.addEventListener("copy", (e) => {
      e.preventDefault();
      this.showAlert("warning", "Copying is not allowed during the test");
    });
    document.addEventListener("paste", (e) => {
      e.preventDefault();
      this.showAlert("warning", "Pasting is not allowed during the test");
    });
    document.addEventListener("cut", (e) => {
      e.preventDefault();
      this.showAlert("warning", "Cutting is not allowed during the test");
    });
  }

  setupCancelButton() {
    // Create cancel button
    const cancelButton = document.createElement("button");
    cancelButton.className = "cancel-button";
    cancelButton.textContent = "Cancel Test";
    document.body.appendChild(cancelButton);

    // Create confirmation modal
    const modal = document.createElement("div");
    modal.id = "confirmation-modal";
    modal.innerHTML = `
      <h3>Are you sure you want to terminate the test?</h3>
      <p>This action cannot be undone.</p>
      <div class="modal-buttons">
        <button class="modal-button confirm-button">Yes, Terminate</button>
        <button class="modal-button cancel-modal-button">No, Continue</button>
      </div>
    `;
    document.body.appendChild(modal);

    // Add click handler for cancel button
    cancelButton.addEventListener("click", () =>
      this.showTerminationConfirmation()
    );
  }

  showTerminationConfirmation() {
    const modal = document.getElementById("confirmation-modal");
    modal.classList.add("visible");

    // Setup button handlers
    const confirmButton = modal.querySelector(".confirm-button");
    const cancelButton = modal.querySelector(".cancel-modal-button");

    confirmButton.onclick = () => {
      modal.classList.remove("visible");
      this.terminateTest("Test cancelled by user");
    };

    cancelButton.onclick = () => {
      modal.classList.remove("visible");
    };
  }

  terminateTest(reason) {
    if (this.isTerminated) return;
    this.isTerminated = true;

    // Hide test content
    const testContainer = document.getElementById("test-container");
    const testContent = document.getElementById("test-content");
    testContainer.style.display = "none";
    testContent.style.display = "none";

    // Show termination message
    this.showAlert("error", `Test terminated: ${reason}`);

    // Optionally exit fullscreen
    if (document.fullscreenElement) {
      document.exitFullscreen();
    }

    // Hide cancel button
    const cancelButton = document.querySelector(".cancel-button");
    cancelButton.classList.remove("visible");

    // Hide confirmation modal if it's visible
    const modal = document.getElementById("confirmation-modal");
    modal.classList.remove("visible");
  }
}

// Initialize secure environment when the page loads
window.addEventListener("load", () => {
  new SecureTestEnvironment();
  // Note: removed automatic initialization
});