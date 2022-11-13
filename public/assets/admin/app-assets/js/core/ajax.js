/*  ===========================================================================================

    =========================================== Ajax Handler ==================================

    ===========================================================================================
*/
/* Register Form are in auth-register.js file */
let root = `/${document.querySelector("#cwd").value}/public/`;
/* Login */
function login(e) {
  e.preventDefault();
  let link = `${root}ajax/login`,
    element = e.currentTarget,
    formdata = new FormData(element),
    btn = document.querySelector(".login-btn");
  btn.disabled = true;
  formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
  $.ajax({
    type: "POST",
    url: link,
    data: formdata,
    dataType: "json",
    success: function (res) {
      console.log(res);
      if ("not-exists" in res) $(".not-exists").css("display", "block");
      else if ("verify" in res) {
        window.location.replace(res["verify"]);
      } else
        window.location.replace(
          `${root}admin/${
            "rejected" in res ? "rejected" : "pending" in res ? "pending" : ""
          }`
        );
    },
    error: function (XHRStatus) {
      console.log(XHRStatus.responseText);
    },
    complete: () => {
      btn.disabled = false;
    },
  });
}
/* Verify */
function verify(e) {
  e.preventDefault();

  let element = e.currentTarget;
  let formdata = new FormData(element);
  formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
  $.ajax({
    type: "POST",
    url: element.getAttribute("action"),
    data: formdata,
    dataType: "json",
    success: function (res) {
      if ("wrong" in res) $(".wrong").css("display", "block");
      // else window.Location.replace(root + "admin");
      console.log(res);
    },
    error: function (XHRStatus) {
      console.log(XHRStatus.responseText);
    },
  });
}

function resend(e) {
  e.preventDefault();
  let link = e.currentTarget;
  link.disabled = true;
  $.ajax({
    type: "POST",
    url: link.getAttribute("href"),
    dataType: "json",
    success: function (res) {},
    error: function (XHRStatus) {
      console.log(XHRStatus.responseText);
    },
    complete: () => {
      link.disabled = false;
    },
  });
}
