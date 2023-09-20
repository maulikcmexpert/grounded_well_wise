const base_url = $("#base_url").val();
var userTimezone = Intl.DateTimeFormat().resolvedOptions().timeZone;
var currentTime = new Date().toLocaleTimeString("en-US", {
  timeZone: userTimezone,
  hour12: false,
});
var timeParts = currentTime.split(":");
var hours = timeParts[0];

$.ajax({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
  },
  type: "POST",
  url: base_url + "current_server_time",
  data: {
    timezone: hours,
  },
  success: function (response) {
    // Handle server response
  },
});
