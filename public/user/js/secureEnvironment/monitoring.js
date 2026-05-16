class MonitoringSystem {
  constructor() {
    this.stream = null;
    this.screenStream = null;
    this.isMonitoring = false;
    this.monitoringInterval = null;
    this.isScreenShared = false;
    this.onSecurityViolation = null; // Callback for security violations
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
}

export default MonitoringSystem;
