root =`/${document.querySelector("#cwd").value}/public/`
$(() => {
    document.querySelectorAll("#add-crt").forEach((el) => {
        el.addEventListener("click", (e) => {
            e.preventDefault();
            let el = e.currentTarget;
            el.style.display = 'none';
            $.ajax({
                type: "POST",
                url: `${root}ajax/tmpCart/addItem`,
                data: JSON.stringify({ id: el.getAttribute("data-id") }),
                dataType: "json",
                success: function (res) {
                    console.log(res)
                },
                error: (xhr) => { console.log(xhr.responseText) },
                complete: () => { el.style.display = 'block'; }
            });
        })
    })
    document.querySelectorAll("#rm-cart-item").forEach(e => {
        e.addEventListener("click", (el => {
            el.preventDefault();
            if (confirm("The effect is occurs immdeiately , continue ?")) {
                $.ajax({
                    type: "POST",
                    url: `${root}ajax/tmpCart/delete`,
                    data: JSON.stringify({ id: el.currentTarget.getAttribute("data-id") }),
                    dataType: "json",
                    success: function (res) {
                        if ('success' in res) window.location.replace(root + 'cart')
                        else console.log(res);
                    },
                    error: (xhr) => { console.log(xhr.responseText) }
                });
            }
        }))
    })
})
function updateCrt(e) {
    e.preventDefault();
    let qtys = document.querySelectorAll("table tbody tr td input[type=number]"),
        ids = document.querySelectorAll("table tbody tr > td a")
    formdata = new FormData;
    for (let i = 0; i < qtys.length; i++) {
        let tmp = {};
        tmp.id = ids[i].getAttribute('data-id'), tmp.qty = qtys[i].value;
        formdata.append(i, JSON.stringify(tmp));
    }
    formdata = JSON.stringify(Object.fromEntries(formdata.entries()));
    $.ajax({
        type: "POST",
        url: root + 'ajax/tmpCart/update',
        data: formdata,
        dataType: "json",
        success: function (res) {
            if ('success' in res) window.location.reload();
            console.log(res)
        },
        error: (xhr) => { console.log(xhr.responseText) }
    });
}