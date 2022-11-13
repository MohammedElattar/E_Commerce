let root = `/${document.querySelector("#cwd").value}/public/`;
document.querySelector(".chkout-frm").addEventListener("submit", (e) => {
    e.preventDefault();
    let btn = document.querySelector(".chkout-btn"),
        formdata = new FormData(e.currentTarget);
    btn.disabled = true;
    formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
    $.ajax({
        type: "POST",
        url: root + "ajax/checkout/add",
        data: formdata,
        dataType: "json",
        success: function () {
            window.location.replace(root + "checkout/summary");
        },
        error: (xhr) => { console.log(xhr.responseText); },
        complete: () => { btn.disabled = false; }
    });

})