root = `/${document.querySelector("#cwd").value}/public/`;
$(function () {
  ("use strict");
  getRoles();
  getUsers();
  $(".roles-table").dataTable({});
});
function getRoles() {
  $.ajax({
    type: "POST",
    url: `${root}ajax/roles/getRoles`,
    dataType: "json",
    success: function (res) {
      if ('not-authorized' in res) console.log("Not authorized get roles")
      else {
        let roles = res["roles"],
          users = res["users"],
          all_users_roles = {},
          cards = "";
        for (i in users) {
          if (users[i]["rule"] in all_users_roles)
            all_users_roles[users[i]["rule"]]++;
          else all_users_roles[users[i]["rule"]] = 1;
        }
        for (i in roles) {
          all_users_roles[roles[i]["name"]] =
            roles[i]["name"] in all_users_roles
              ? all_users_roles[roles[i]["name"]]
              : 0;
          cards += `<div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <span>Total ${all_users_roles[roles[i]["name"]]
            } users</span>
                    <a href="${root}ajax/roles/delete" data-id="${roles[i]["id"]
            }" onclick="deleteRole(event)"><i data-feather="trash" aria-hidden="true"></i></a>
                </div>
                <div class="d-flex justify-content-between align-items-end mt-1 pt-25">
                    <div class="role-heading">
                        <h4 class="fw-bolder">${roles[i]["name"].charAt(0).toUpperCase() +
            roles[i]["name"].slice(1)
            }</h4>
                        <a href="javascript:;" class="role-edit-modal" data-bs-toggle="modal"
                            data-bs-target="#editRole" data-id="${roles[i]["id"]
            }" onclick="editRole(event)">
                            <small class="fw-bolder">Edit Role</small>
                        </a>
                    </div>
                    <a href="javascript:void(0);" class="text-body"><i data-feather="copy"
                            class="font-medium-5"></i></a>
                </div>
            </div>
        </div>
    </div>`;
        };
        cards += res['add-role'];
        $(".roles-list").html(cards);
      }

    },
    error: (xhr) => {
      console.log(xhr.responseText);
    },
  });
}
function addRole(e) {
  e.preventDefault();
  let form = document.querySelector("#addRoleForm");
  let formdata = new FormData(form);
  formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
  $.ajax({
    type: "POST",
    url: form.getAttribute("action"),
    data: formdata,
    dataType: "json",
    success: function (res) {
      if ('not-authorized' in res) console.log("Not Authorized");
      else { if ("success" in res) getRoles(); }
    },
    error: (xhr) => {
      console.log(xhr.responseText);
    },
  });
}

function editRole(e) {
  // get item Info
  let formdata = new FormData(),
    form = document.querySelector("#editRoleForm"),
    id = e.currentTarget.getAttribute("data-id");
  formdata.append("id", id);
  formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
  $.ajax({
    type: "POST",
    url: root + "ajax/roles/getItem",
    data: formdata,
    dataType: "json",
    success: function (res) {
      if ("not-authorized" in res) console.log("Not Authorized")
      else {
        if ("success" in res) {
          var [
            rolesName,
            userName,
            categoryName,
            productName,
            orderName,
            dbName,
          ] = ["roles_s", "user", "categories", "products", "orders", "db"];
          $("#editRoleForm input[name=name]").val(res["data"]["name"]);
          let user = JSON.parse(res["data"][userName]),
            // add a new role here
            category = JSON.parse(res["data"][categoryName]),
            product = JSON.parse(res["data"][productName]),
            order = JSON.parse(res["data"][orderName]),
            db = JSON.parse(res["data"][dbName]),
            roles = JSON.parse(res["data"][rolesName]),
            permissions = ["Read", "Write", "Create"],
            cnt = 0;
          for (i in res["data"]) {
            if (isNaN(+i)) {
              // add a new role here
              if (
                [
                  categoryName,
                  userName,
                  productName,
                  orderName,
                  dbName,
                  rolesName,
                ].indexOf(i) != -1
              ) {
                for (j = 0; j < 3; j++) {
                  let chk = document.querySelector(
                    `#editRoleForm input[name=${i + permissions[cnt]}]`
                  );
                  // edit the condition to add a new role here
                  var s =
                    i == userName
                      ? +user[j]
                      : i == categoryName
                        ? +category[j]
                        : i == productName
                          ? +product[j]
                          : i == orderName
                            ? +order[j]
                            : i == dbName
                              ? +db[j]
                              : +roles[j];
                  if (s) chk.setAttribute("checked", "checked");
                  else chk.removeAttribute("checked");
                  cnt++;
                }
                cnt = 0;
              }
            }
          }
        }
      }
    },
    error: (xhr) => {
      console.log(xhr.responseText);
    },
  });

  // Update db
  if (form) {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      formdata = new FormData(form);
      formdata.append("id", id);
      formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
      $.ajax({
        type: "POST",
        url: form.getAttribute("action"),
        data: formdata,
        dataType: "json",
        success: function (res) {
          console.log(res);
          getRoles();
        },
        error: (xhr) => {
          console.log(xhr.responseText);
        },
      });
    });
  }
}

function deleteRole(e) {
  e.preventDefault();
  if (confirm("That Will ALso Delete All Users With That Permission")) {
    let id = e.currentTarget.getAttribute("data-id");
    let formdata = new FormData();
    formdata.append("id", id);
    formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
    $.ajax({
      type: "POST",
      url: root + "ajax/roles/delete",
      data: formdata,
      dataType: "json",
      success: function (res) {
        if ('not-authorized' in res) console.log("Not Authorized")
        else
          getRoles();
      },
      error: (xhr) => {
        console.log(xhr.responseText);
      },
    });
  }
}

function getUsers() {
  $.ajax({
    type: "POST",
    url: root + "ajax/roles/getUsers",
    dataType: "json",
    success: function (res) {
      if (typeof res == 'object' && 'not-authorized' in res) console.log("Not Authorized To Get Users")
      else
        $(".roles-table tbody").html(res);
    },
    error: (xhr) => {
      console.log(xhr.responseText);
    },
  });
}
