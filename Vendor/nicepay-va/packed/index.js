$("#va-btn").click(function() {
  $("#va-form").show();
  $("#cc-form").hide();
  $("#fix-form").hide();
  $("#cust-form").hide();
  $("#deposit-form").hide();
  $("#vad-form").hide();
  $("#va-btn").addClass("active");
  $("#cc-btn").removeClass("active");
  $("#fix-btn").removeClass("active");
  $("#deposit-btn").removeClass("active");
  $("#cust-btn").removeClass("active");
  $("#vad-btn").removeClass("active");
});


$("#cc-btn").click(function() {
  $("#va-form").hide();
  $("#fix-form").hide();
  $("#cust-form").hide();
  $("#deposit-form").hide();
  $("#vad-form").hide();
  $("#cc-form").show();
  $("#va-btn").removeClass("active");
  $("#cust-btn").removeClass("active");
  $("#fix-btn").removeClass("active");
  $("#deposit-btn").removeClass("active");
  $("#vad-btn").removeClass("active");
  $("#cc-btn").addClass("active");
});

$("#fix-btn").click(function() {
  $("#va-form").hide();
  $("#cc-form").hide();
  $("#cust-form").hide();
  $("#deposit-form").hide();
  $("#fix-form").show();
  $("#vad-form").hide();
  $("#va-btn").removeClass("active");
  $("#cc-btn").removeClass("active");
  $("#cust-btn").removeClass("active");
  $("#deposit-btn").removeClass("active");
  $("#vad-btn").removeClass("active");
  $("#fix-btn").addClass("active");
});

$("#cust-btn").click(function() {
  $("#va-form").hide();
  $("#cc-form").hide();
  $("#fix-form").hide();
  $("#deposit-form").hide();
  $("#vad-form").hide();
  $("#cust-form").show();
  $("#va-btn").removeClass("active");
  $("#cc-btn").removeClass("active");
  $("#fix-btn").removeClass("active");
  $("#deposit-btn").removeClass("active");
  $("#vad-btn").removeClass("active");
  $("#cust-btn").addClass("active");
});

$("#deposit-btn").click(function() {
  $("#va-form").hide();
  $("#cc-form").hide();
  $("#fix-form").hide();
  $("#cust-form").hide();
  $("#vad-form").hide();
  $("#deposit-form").show();
  $("#va-btn").removeClass("active");
  $("#cc-btn").removeClass("active");
  $("#fix-btn").removeClass("active");
  $("#cust-btn").removeClass("active");
  $("#vad-btn").removeClass("active");
  $("#deposit-btn").addClass("active");
});

$("#vad-btn").click(function() {
  $("#va-form").hide();
  $("#cc-form").hide();
  $("#fix-form").hide();
  $("#cust-form").hide();
  $("#deposit-form").hide();
  $("#vad-form").show();
  $("#va-btn").removeClass("active");
  $("#cc-btn").removeClass("active");
  $("#fix-btn").removeClass("active");
  $("#cust-btn").removeClass("active");
  $("#deposit-btn").removeClass("active");
  $("#vad-btn").addClass("active");
});