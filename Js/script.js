$(document).ready(function () {
  $(".login-trigger").click(function () {
    $("#loginModal").modal("show");
  });
});

$(document).ready(function () {
  $(".login-trigger").on("click", function (event) {
    event.preventDefault();
    $("#loginModal").modal("show");
  });
});

AOS.init({
  duration: 1000,
  once: true,
});

// Modal Functionality
document.addEventListener("DOMContentLoaded", function () {
  // Elements
  const loginModal = document.getElementById("loginModal");
  const registerModal = document.getElementById("registerModal");
  const closeButtons = document.querySelectorAll(".auth-close");
  const switchToRegister = document.querySelector(".switch-to-register");
  const switchToLogin = document.querySelector(".switch-to-login");

  // Open Login Modal
  window.openLoginModal = function () {
    loginModal.style.display = "block";
    document.body.style.overflow = "hidden";
  };

  // Open Register Modal
  window.openRegisterModal = function () {
    registerModal.style.display = "block";
    document.body.style.overflow = "hidden";
  };

  // Close Modals
  function closeModals() {
    loginModal.style.display = "none";
    registerModal.style.display = "none";
    document.body.style.overflow = "auto";
  }

  // Event Listeners
  closeButtons.forEach((btn) => {
    btn.addEventListener("click", closeModals);
  });

  if (switchToRegister) {
    switchToRegister.addEventListener("click", function (e) {
      e.preventDefault();
      loginModal.style.display = "none";
      registerModal.style.display = "block";
    });
  }

  if (switchToLogin) {
    switchToLogin.addEventListener("click", function (e) {
      e.preventDefault();
      registerModal.style.display = "none";
      loginModal.style.display = "block";
    });
  }

  // Close when clicking outside
  window.addEventListener("click", function (e) {
    if (e.target === loginModal || e.target === registerModal) {
      closeModals();
    }
  });

  // Password toggle function
  window.togglePassword = function (id, element) {
    const passwordInput = document.getElementById(id);
    const icon = element.querySelector("i");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    } else {
      passwordInput.type = "password";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    }
  };
});

//edit profile
document.querySelectorAll(".custom-select").forEach((select) => {
  select.addEventListener("change", function () {
    const label = this.nextElementSibling;
    if (this.value) {
      label.style.top = "-10px";
      label.style.left = "10px";
      label.style.fontSize = "12px";
      label.style.backgroundColor = "white";
      label.style.padding = "0 5px";
      label.style.color = "#6c63ff";
    } else {
      label.style.top = "15px";
      label.style.left = "15px";
      label.style.fontSize = "";
      label.style.backgroundColor = "";
      label.style.padding = "";
      label.style.color = "#999";
    }
  });
});

//admin

document.getElementById("toggleSidebar").addEventListener("click", function () {
  document.getElementById("sidebar").classList.toggle("active");
  document.getElementById("sidebarOverlay").classList.toggle("active");
  document.body.classList.toggle("sidebar-open");
});

// Close sidebar when clicking overlay
document
  .getElementById("sidebarOverlay")
  .addEventListener("click", function () {
    document.getElementById("sidebar").classList.remove("active");
    this.classList.remove("active");
    document.body.classList.remove("sidebar-open");
  });

document.getElementById("toggleSidebar").addEventListener("click", function () {
  document.getElementById("sidebar").classList.toggle("active");
  document.getElementById("sidebarOverlay").classList.toggle("active");
  document.body.classList.toggle("sidebar-open");
});

// Close sidebar when clicking overlay
document
  .getElementById("sidebarOverlay")
  .addEventListener("click", function () {
    document.getElementById("sidebar").classList.remove("active");
    this.classList.remove("active");
    document.body.classList.remove("sidebar-open");
  });

//add vehicle

$(document).ready(function () {
  // Update file input label with selected file name
  $(".custom-file-input").on("change", function () {
    let fileName = $(this).val().split("\\").pop();
    $(this)
      .next(".custom-file-label")
      .html(fileName || "Choose vehicle image...");
  });

  // Initialize floating labels for select elements
  $(".custom-select")
    .on("change", function () {
      const label = $(this).siblings(".floating-label");
      if ($(this).val()) {
        label.addClass("active");
      } else {
        label.removeClass("active");
      }
    })
    .trigger("change");

  // Add active class to floating labels when input has value
  $(".form-control")
    .on("input", function () {
      const label = $(this).siblings(".floating-label");
      if ($(this).val()) {
        label.addClass("active");
      } else {
        label.removeClass("active");
      }
    })
    .trigger("input");
});
