/**
 * DataTables Basic
 */
let root = `/${document.querySelector("#cwd").value}/public/`,
  products_Table = $(".products"),
  orders_Table = $(".orders"),
  users = $(".users");
if (products_Table.length) getTableContent(root + "ajax/products/getContents", ".products tbody");
if (orders_Table.length) getTableContent(root + "ajax/orders/getContents", ".orders tbody");
if (users.length) getTableContent(root + "ajax/users/getUsers", ".users tbody");
$(function () {
  if (products_Table) $(".products").dataTable({});
  if (orders_Table) $(".orders").dataTable({});
})
function getTableContent(url, tableRefer, datatable = "") {
  $.ajax({
    type: "POST",
    url: url,
    success: function (res) {
      $(tableRefer).html(res);
    },
    error: function (XHRStatus) {
      console.log(XHRStatus.responseText);
    },
  });
}
function editCategoryStatus(event, url = "") {
  event.preventDefault();
  let element = event.currentTarget;
  let formdata = new FormData();
  let link = url ? url : element.getAttribute("href");
  formdata.append("id", element.getAttribute("data-id"));
  formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
  $.ajax({
    type: "POST",
    url: link,
    data: formdata,
    success: function (res) {
      console.log(res)
      res = JSON.parse(res);
      if ("success" in res) {
        getTableContent(
          root + "ajax/categories/getContents",
          ".datatables-basic tbody"
        );
      }
    },
    error: function (xhr) {
      console.log(xhr);
    },
  });
}

function hideAlerts(alerts, word = "") {
  alerts.forEach(e => {
    $(word + e).css("display", 'none');
  })
}
/* =========================================================Categories =============================================================*/
$(function () {
  "use strict";

  var category_table = $(".datatables-basic"),
    assetPath = `${root}assets/admin/app-assets/`;
  if ($("body").attr("data-framework") === "laravel") {
    assetPath = $("body").attr("data-asset-path");
  }

  // DataTable with buttons
  // --------------------------------------------------------------------
  if (category_table.length) {
    getTableContent(
      root + "ajax/categories/getContents",
      ".datatables-basic tbody"
    );
  }

  // Delete Record
  $(".datatables-basic tbody").on("click", ".delete-record", function (e) {
    e.preventDefault();
    if (confirm("Delete ? ")) {
      let element = e.currentTarget;
      $.ajax({
        type: "POST",
        url: element.getAttribute("href"),
        success: function (res) {
          res = JSON.parse(res);
          if ("success" in res) {
            getTableContent(
              root + "ajax/categories/getContents",
              ".datatables-basic tbody", ".datatables-basic"
            );
          }
        },
        error: function (xhr) {
          console.log(xhr);
        },
      });
    }
  });
});
function addCategory(e) {
  let form = e.currentTarget;
  e.preventDefault();
  let formdata = new FormData(form);
  formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
  let inpt = document.querySelector("#add_cat_name");
  inpt.value = "";
  inpt.focus();
  $.ajax({
    type: "POST",
    url: form.getAttribute("action"),
    data: formdata,
    success: function (res) {
      res = JSON.parse(res);
      console.log(res);
      if ('name' in res) $(".name").css("display", 'block')
      if ('exists' in res) $(".exists").css('display', 'block')
      if ("success" in res) {
        hideAlerts(['.name', '.exists'])
        $(".success").css('display', 'block');
        getTableContent(
          root + "ajax/categories/getContents",
          ".datatables-basic tbody", ".datatables-basic"
        );
      }
      setTimeout(hideAlerts.bind(null, [".exists", '.name', '.success']), 3000)
    },
    error: function (xhr) {
      console.log(xhr);
    },
  });
}
function editCategory(e) {
  e.preventDefault();
  let btn = e.currentTarget,
    id = btn.getAttribute("data-id"),
    form = document.querySelector(".category-edit"),
    inpt = document.querySelector("#edit_cat_name");
  $.post(root + "ajax/categories/getItem", id, (data) => {
    inpt.value = data;
    inpt.focus();
  });
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    formdata = new FormData(form);
    formdata.append("id", id);
    formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
    $.ajax({
      type: "POST",
      url: form.getAttribute("action"),
      data: formdata,
      success: function (res) {
        res = JSON.parse(res);
        if ('name' in res) $(".edit-name").css("display", 'block');
        if ('exists' in res) $(".edit-exists").css("display", 'block');
        if ("success" in res) {
          hideAlerts(['.edit-name', '.edit-exists'])
          $(".edit-success").css("display", 'block')
          getTableContent(
            root + "ajax/categories/getContents",
            ".datatables-basic tbody", ".datatables-basic"
          );
        }
        console.log(res)
        setTimeout(hideAlerts.bind(null, [".edit-exists", '.edit-name', '.edit-success']), 3000)
      },
      error: function (xhr) {
        console.log(xhr);
      },
      complete: function () { },
    });
  });
}

/*============================================================== Products ==============================================================*/



function addProduct() {
  let form = document.querySelector(".product-add");
  //get categories
  let slct = document.querySelector("#category_name");
  $.ajax({
    type: "POST",
    url: root + "ajax/products/getCategories",
    success: function (res) {
      let cats = "";
      res = JSON.parse(res);
      for (const i in res) {
        cats += `<option value="${res[i].id}">${res[i].cat_name}</option>`;
      }
      slct.innerHTML = cats;
    },
    error: (xhr) => {
      console.log(xhr);
    },
  });
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    let formdata = new FormData(form);
    let photos = document.querySelector(".product-add input[type=file]");
    if (photos) {
      photos = photos.files;
      let cnt = 0;
      Object.keys(photos).forEach((e) => {
        if (cnt < 4) formdata.append(`photo_${cnt}`, photos[e]);
        cnt++;
      });
    }
    let inpt = document.querySelector("#add_prod_name");
    inpt.value = "";
    inpt.focus();
    $.ajax({
      type: "POST",
      url: form.getAttribute("action"),
      data: formdata,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (res) {
        console.log(res);
        let errors = ['name', 'category', 'description', 'quantity', 'price', 'discount', 'photos', 'prod-exists']
        errors.forEach(e => { if (e in res) $(`.error-${e}`).css('display', 'block') })
        if ("success" in res) {
          errors.forEach(e => { if (e in res) $(`.error-${e}`).css('display', 'none') })
          $(".error-success").css("display", 'block');
          getTableContent(
            root + "ajax/products/getContents",
            ".products tbody", ".products"
          );
        }
        errors.push('success');
        setTimeout(hideAlerts.bind(null, errors, '.error-'), 7000)
      },
      error: function (xhr) {
        console.log(xhr.responseText);
      },
    });
  });
}
function editProduct(event) {
  let btn = event.currentTarget;
  let id = btn.getAttribute("data-id");
  let formdata = new FormData();
  formdata.append("id", id);
  formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
  let form = document.querySelector(".product-edit");
  form.setAttribute("data-id", id);
  //get categories
  let slct = document.querySelector("#category_name_edit");
  $.ajax({
    type: "POST",
    url: root + "ajax/products/getItem",
    data: formdata,
    success: function (data) {
      data = JSON.parse(data);
      if ("success" in data) {
        //get categories
        $.ajax({
          type: "POST",
          url: root + "ajax/products/getCategories",
          success: function (res) {
            let cats = "";
            res = JSON.parse(res);
            for (const i in res) {
              cats += `<option value="${res[i].id}" ${res[i].id == data["data"]["category_id"] ? "selected" : ""
                }>${res[i].cat_name}</option>`;
            }
            $("#editProduct [name=name]").val(data["data"]["name"]);
            $("#category_name_edit").html(cats);
            $("#editProduct [name=quantity]").val(data["data"]["quantity"]);
            $("#editProduct [name=price]").val(data["data"]["price"]);
            $("#editProduct [name=description]").val(data["data"]["description"]);
            $("#editProduct [name=discount]").val(data["data"]["discount"]);
          },
          error: (xhr) => {
            console.log(xhr);
          },
        });
      }
    },
    error: (xhr) => {
      console.log(xhr);
    },
  });
}
function editProductSubmit(e) {
  e.preventDefault()
  let form = e.currentTarget
  let formdata = new FormData(form),
    btn = document.querySelector(".edit-product-btn");
  btn.disabled = true;
  formdata.append("id", form.getAttribute("data-id"));
  let photos = document.querySelector(".product-edit input[type=file]");
  if (photos) {
    photos = photos.files;
    let cnt = 1;
    Object.keys(photos).forEach((e) => {
      if (cnt < 4) formdata.append(`photo_${cnt}`, photos[e]);
      cnt++;
    });
  }
  $.ajax({
    type: "POST",
    url: form.getAttribute("action"),
    data: formdata,
    contentType: false,
    processData: false,
    cache: false,
    dataType: "json",
    success: function (res) {
      console.log(res);
      let errors = ['name', 'category', 'description', 'quantity', 'price', 'discount', 'photos', 'prod-exists']
      errors.forEach(e => { if (e in res) $(`.error-edit-${e}`).css('display', 'block') })
      if ("success" in res) {
        errors.forEach(e => { if (e in res) $(`.error-${e}`).css('display', 'none') })
        $(".error-edit-success").css("display", 'block');
        getTableContent(
          root + "ajax/products/getContents",
          ".products tbody", ".products"
        );
      }
      errors.push('success');
      setTimeout(hideAlerts.bind(null, errors, '.error-edit-'), 7000)
    },
    error: function (xhr) {
      console.log(xhr.responseText);
    },
    complete: () => { btn.disabled = false }
  });
}

function deleteProduct(e) {
  e.preventDefault();
  let btn = e.currentTarget;
  if (confirm("Delete ? ")) {
    $.ajax({
      type: "POST",
      url: btn.getAttribute("href"),
      dataType: "json",
      success: function (res) {
        console.log(res);
        if ("success" in res) {
          getTableContent(`${root}ajax/products/getContents`, '.products tbody')
        }
      },
      error: function (xhr) { console.log(xhr.responseText) }
    });
  }
}


/*===================================================== Orders ===================================================================== */

function getOrderInfo(event) {
  let btn = event.currentTarget;
  btn.disable = true;
  let id = btn.getAttribute("data-id");
  let formdata = new FormData();
  formdata.append("id", id);
  formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
  let form = document.querySelector(".orders-edit");
  //get categories
  let slct = document.querySelector("#prodcuts_edit");
  $.ajax({
    type: "POST",
    url: root + "ajax/orders/getOrder",
    data: formdata,
    contentType: 'json',
    success: function (data) {
      data = JSON.parse(data);
      if ('success' in data) {
        let keys = Object.keys(data['data']).slice(6);
        keys.forEach(e => {
          if (e != "products") $(`#${e}`).val(data['data'][e])
          else {
            let products = JSON.parse(data['data']['products']),
              tbody = "",
              tfoot = "";
            for (i in products) {
              tbody += `<tr>
                    <td>${products[i]['name']}</td>
                    <td>${products[i]['quantity']}</td>
                    <td>${products[i]['price']}</td>
              </tr>`
            }
            $(".products-orders-table tbody").html(tbody);
          }
        })
      }
    },
    error: (xhr) => {
      console.log(xhr.responseText);
    },
  });
}
function editOrderStatus(e) {
  e.preventDefault();
  let el = e.currentTarget;
  $.ajax({
    type: "POST",
    url: el.getAttribute("href"),
    data: JSON.stringify({ id: el.getAttribute("data-id"), status: el.getAttribute('stats-id') }),
    dataType: "json",
    success: (res) => {
      if ('not-authoirzed' in res) console.log("Not Authorized to edit Order Status");
      else if ('success' in res) {
        getTableContent(
          root + "ajax/orders/getContents",
          ".orders tbody"
        );
      }
      console.log(res)
    },
    error: (xhr) => { console.log(xhr.responseText) }
  });
}
function deleteOrder(e) {
  e.preventDefault();
  let btn = e.currentTarget;
  if (confirm("Delete ? ")) {
    $.ajax({
      type: "POST",
      url: btn.getAttribute("href"),
      dataType: "json",
      success: function (res) {
        console.log(res);
        if ("success" in res) {
          getTableContent(`${root}ajax/orders/getContents`, '.orders tbody')
        }
      },
      error: function (xhr) { console.log(xhr.responseText) }
    });
  }
}

/* ============================================================= Users ================================================================= */

function addUser() {
  // get Roles
  $.ajax({
    type: "POST",
    url: root + "ajax/users/getRoles",
    dataType: "json",
    success: function (res) {
      let roles = "";
      for (i in res) {
        roles += `<option value="${res[i]['id']}">${res[i]['name']}</option>`;
      }
      $("#roles_slct").html(roles);
    },
    error: (xhr) => { console.log(xhr.responseText) }
  });

  // insert data
  let form = document.querySelector(".user-add");
  form.addEventListener("submit", (e) => {
    let formdata = new FormData(form);
    formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
    console.log(formdata);
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: form.getAttribute("action"),
      data: formdata,
      dataType: "json",
      success: function (res) {
        console.log(res)
        // if ('success' in res)
        let errors = ['name', 'username', 'email', 'pass', 'role', 'username-exists', 'email-exists', 'role-not-exists']
        errors.forEach(e => { if (e in res) $(`.error-${e}`).css('display', 'block') })
        if ("success" in res) {
          errors.forEach(e => { if (e in res) $(`.error-${e}`).css('display', 'none') })
          $(".error-success").css("display", 'block');
          getTableContent(root + "ajax/users/getUsers", ".users tbody");
        }
        errors.push('success');
        setTimeout(hideAlerts.bind(null, errors, '.error-'), 5000)
      },
      error: (xhr) => { console.log(xhr.responseText) }
    });
  })

}
function editUser(e) {
  // get User Info
  let formdata = new FormData(),
    id = e.currentTarget.getAttribute('data-id');
  formdata.append('id', id)
  $.ajax({
    type: "POST",
    url: root + "ajax/users/getItem",
    data: JSON.stringify(Object.fromEntries(formdata.entries())),
    dataType: "json",
    success: function (res) {
      if ('success' in res) {
        $("#name_edit").val(res['data']['first_name']),
          $("#edit_username").val(res['data']['username']),
          $("#edit_useremail").val(res['data']['email']);
        // get Roles
        $.ajax({
          type: "POST",
          url: root + "ajax/users/getRoles",
          dataType: "json",
          success: function (data) {
            let roles = "";
            for (i in data) {
              roles += `<option value="${data[i]['id']}" ${data[i]['id'] == res['data']['rule'] ? 'selected' : ''}>${data[i]['name']}</option>`;
            }
            $("#roles_slct_edit").html(roles);
          },
          error: (xhr) => { console.log(xhr.responseText) }
        });
      }
    },
    error: (xhr) => { console.log("Error is ", xhr.responseText) }
  });


  // Update data
  let form = document.querySelector(".user-edit");
  if (form) {
    form.addEventListener("submit", (e) => {
      e.preventDefault();
      let formdata = new FormData(form);
      formdata.append('id', id);
      formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: form.getAttribute("action"),
        data: formdata,
        dataType: "json",
        success: function (res) {
          let errors = ['name', 'username', 'email', 'pass', 'role', 'username-exists', 'email-exists', 'role-not-exists']
          errors.forEach(e => { if (e in res) $(`.error-edit-${e}`).css('display', 'block') })
          if ("success" in res) {
            errors.forEach(e => { if (e in res) $(`.error-${e}`).css('display', 'none') })
            $(".error-sedit-uccess").css("display", 'block');
            getTableContent(root + "ajax/users/getUsers", ".users tbody");
          }
          errors.push('success');
          setTimeout(hideAlerts.bind(null, errors, '.error-edit-'), 5000)
        },
        error: (xhr) => { console.log(xhr.responseText) }
      });
    })
  }
}

function deleteUser(e) {
  let el = e.currentTarget;
  e.preventDefault();
  // delete User From DB
  if (confirm("Sure ? ")) {
    $.ajax({
      type: "POST",
      url: root + "ajax/users/delete",
      data: JSON.stringify({ id: el.getAttribute("data-id") }),
      dataType: 'json',
      success: function (res) {
        console.log(res)
        if ('success' in res) {
          if ('same' in res) location.replace(root + "admin/logout");
          else getTableContent(root + "ajax/users/getUsers", ".users tbody");
        }
      },
      error: (xhr) => { console.log(xhr.responseText) }
    });
  }
}
function editUserStatus(e) {
  e.preventDefault();
  if (confirm("The effect is occurs Immediately , continue ? ")) {
    let el = e.currentTarget;
    let id = el.getAttribute('data-id'),
      stats = el.getAttribute('sts-id');
    $.ajax({
      type: "POST",
      url: el.getAttribute("href"),
      data: JSON.stringify({ id: id, status: stats }),
      dataType: "json",
      success: function (res) {
        if ("not-authorized" in res) console.log("You are not authorized to edit Status");
        if ('success' in res) {
          if ('same' in res) location.replace(root + 'admin/logout');
          getTableContent(root + "ajax/users/getUsers", ".users tbody");
        }
      },
      error: (xhr) => { console.log(xhr.responseText) }
    });
  }
}