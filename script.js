$(document).ready(function () {
  $("#registrationForm").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: "process.php",
      type: "POST",
      data: $(this).serialize(),
      success: function (response) {
        $("#response").html(response).fadeIn();
        $("#registrationForm")[0].reset();
      },
      error: function () {
        $("#response")
          .html("<p style='color:red;'>Error submitting form.</p>")
          .fadeIn();
      },
    });
  });
});
