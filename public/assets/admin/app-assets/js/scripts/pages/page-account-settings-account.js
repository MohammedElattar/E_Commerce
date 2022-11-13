$(function () {
  ('use strict');

  // variables
  let root = `/${document.querySelector("#cwd").value}/public/`;
  var form = $('.validate-form'),
    accountUploadImg = $('#account-upload-img'),
    accountUploadBtn = $('#account-upload'),
    accountUserImage = $('.uploadedAvatar'),
    accountResetBtn = $('#account-reset'),
    accountNumberMask = $('.account-number-mask'),
    accountZipCode = $('.account-zip-code'),
    select2 = $('.select2'),
    deactivateAcc = document.querySelector('#formAccountDeactivation'),
    deactivateButton = deactivateAcc.querySelector('.deactivate-account');

  // Update user photo on click of button

  if (accountUserImage) {
    var resetImage = accountUserImage.attr('src');
    accountUploadBtn.on('change', function (e) {
      var reader = new FileReader(),
        files = e.target.files;
      reader.onload = function () {
        if (accountUploadImg) {
          accountUploadImg.attr('src', reader.result);
        }
      };
      reader.readAsDataURL(files[0]);
    });

    accountResetBtn.on('click', function () {
      accountUserImage.attr('src', resetImage);
    });
  }

  // jQuery Validation for all forms
  // --------------------------------------------------------------------
  if (form.length) {
    form.each(function () {
      var $this = $(this);

      $this.validate({
        rules: {
          firstName: {
            required: true
          },
          lastName: {
            required: false
          },
          accountActivation: {
            required: true
          }
        }
      });
      $this.on('submit', function (e) {
        e.preventDefault();
        let form = e.currentTarget;
        let formdata = new FormData(form),
          file = document.querySelector("[type=file]").files;
        if (file.length) {
          formdata.append('avatar', file[0])
        }
        $.ajax({
          type: "POST",
          url: form.getAttribute("action"),
          data: formdata,
          processData: false,
          contentType: false,
          cache: false,
          dataType: 'json',
          success: function (res) {
            console.log(res)
          },
          error: (xhr) => { console.log(xhr.responseText) }
        });
      });
    });
  }

  // disabled submit button on checkbox unselect
  if (deactivateAcc) {
    $(document).on('click', '#accountActivation', function () {
      if (accountActivation.checked == true) {
        deactivateButton.removeAttribute('disabled');
      } else {
        deactivateButton.setAttribute('disabled', 'disabled');
      }
    });
  }

  // Deactivate account alert
  const accountActivation = document.querySelector('#accountActivation');

  // Alert With Functional Confirm Button
  if (deactivateButton) {
    deactivateButton.onclick = function () {
      if (accountActivation.checked == true) {

        Swal.fire({
          text: 'Are you sure you would like to deactivate your account?',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes',
          customClass: {
            confirmButton: 'btn btn-primary',
            cancelButton: 'btn btn-outline-danger ms-2'
          },
          buttonsStyling: false
        }).then(function (result) {
          if (result.value) {
            // delete User From DB
            $.ajax({
              type: "POST",
              url: root + "ajax/profile/delete",
              dataType: 'json',
              success: function (res) {
                if ("success" in res) location.replace(root + "admin/logout");
                console.log(res);
              },
              error: (xhr) => { console.log(xhr.responseText) }
            });
            Swal.fire({
              icon: 'success',
              title: 'Deleted!',
              text: 'Your file has been deleted.',
              customClass: {
                confirmButton: 'btn btn-success'
              }
            });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal.fire({
              title: 'Cancelled',
              text: 'Deactivation Cancelled!!',
              icon: 'error',
              customClass: {
                confirmButton: 'btn btn-success'
              }
            });
          }
        });
      }
    };
  }

  //phone
  if (accountNumberMask.length) {
    accountNumberMask.each(function () {
      new Cleave($(this), {
        phone: true,
        phoneRegionCode: 'US'
      });
    });
  }

  //zip code
  if (accountZipCode.length) {
    accountZipCode.each(function () {
      new Cleave($(this), {
        delimiter: '',
        numeral: true
      });
    });
  }

  // For all Select2
  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
        dropdownParent: $this.parent()
      });
    });
  }
});
