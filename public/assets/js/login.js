const sign_in_btn = document.querySelector("#sign-in-btn"),
  sign_up_btn = document.querySelector("#sign-up-btn"),
  container = document.querySelector(".container"),
  root = `/${document.querySelector("#cwd").value}/public/`;

sign_up_btn.addEventListener("click", () => {
  container.classList.add("sign-up-mode");
});

sign_in_btn.addEventListener("click", () => {
  container.classList.remove("sign-up-mode");
});

// login
document.querySelector(".login-frm").addEventListener("submit", (e) => {
  e.preventDefault();
  let form = e.currentTarget,
    btn = document.querySelector(".login-btn"),
    formdata = new FormData(form);
  btn.disabled = true;
  formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
  $.ajax({
    type: "POST",
    url: root + "ajax/clientLogin",
    data: formdata,
    dataType: "json",
    success: function (res) {
      if ('success' in res) window.location.replace(root);
      console.log(res)
    },
    error: (xhr) => { console.log(xhr.responseText) },
    complete: () => { btn.disabled = false }
  });
})

// register

document.querySelector(".signup-frm").addEventListener("submit", (e) => {
  e.preventDefault();
  let form = e.currentTarget,
    btn = document.querySelector(".signup-btn"),
    formdata = new FormData(form);
  btn.disabled = true;
  formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
  $.ajax({
    type: "POST",
    url: root + "ajax/clientRegister",
    data: formdata,
    dataType: "json",
    success: function (res) {
      if ('success' in res) window.location.replace(root + "login");
      console.log(res)
    },
    error: (xhr) => { console.log(xhr.responseText) },
    complete: () => { btn.disabled = false }
  });
})
