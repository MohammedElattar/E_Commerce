/*=========================================================================================
  File Name: auth-register.js
  Description: Auth register js file.
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy  - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: PIXINVENT
  Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/

$(function () {
  ('use strict');
  var assetsPath = `/${document.querySelector("#cwd").value}/public/admin/assets/app-assets/`,
    registerMultiStepsWizard = document.querySelector('.register-multi-steps-wizard'),
    pageResetForm = $('.auth-register-form'),
    select = $('.select2');

  if ($('body').attr('data-framework') === 'laravel') {
    assetsPath = $('body').attr('data-asset-path');
  }

  // jQuery Validation
  // --------------------------------------------------------------------
  if (pageResetForm.length) {
    pageResetForm.validate({
      /*
      * ? To enable validation onkeyup
      onkeyup: function (element) {
        $(element).valid();
      },*/
      /*
      * ? To enable validation on focusout
      onfocusout: function (element) {
        $(element).valid();
      }, */
      rules: {
        'register-username': {
          required: true
        },
        'register-email': {
          required: true,
          email: true
        },
        'register-password': {
          required: true
        }
      }
    });
  }

  // multi-steps registration
  // --------------------------------------------------------------------

  // Horizontal Wizard
  if (typeof registerMultiStepsWizard !== undefined && registerMultiStepsWizard !== null) {
    var numberedStepper = new Stepper(registerMultiStepsWizard),
      $form = $(registerMultiStepsWizard).find('form');
    $form.each(function () {
      var $this = $(this);
      $this.validate({
        rules: {
          username: {
            required: true
          },
          email: {
            required: true
          },
          password: {
            required: true,
            minlength: 8
          },
          'confirm-password': {
            required: true,
            minlength: 8,
            equalTo: '#password'
          },
          'first-name': {
            required: true
          }
        },
        messages: {
          password: {
            required: 'Enter new password',
            minlength: 'Enter at least 8 characters'
          },
          'confirm-password': {
            required: 'Please confirm new password',
            minlength: 'Enter at least 8 characters',
            equalTo: 'The password and its confirm are not the same'
          }
        }
      });
    });

    $(registerMultiStepsWizard)
      .find('.btn-next')
      .each(function () {
        $(this).on('click', function (e) {
          var isValid = $(this).parent().siblings('form').valid();
          if (isValid) {
            numberedStepper.next();
          } else {
            e.preventDefault();
          }
        });
      });

    $(registerMultiStepsWizard)
      .find('.btn-prev')
      .on('click', function () {
        numberedStepper.previous();
      });

    $(registerMultiStepsWizard)
      .find('.btn-submit')
      .on('click', function () {
        var isValid = $(this).parent().siblings('form').valid();
        if (isValid) {
          let btn = document.querySelector(".btn-submit");
          btn.disabled = true;
          let url = `/${document.querySelector("#cwd").value}/public/ajax/register`;
          let formdata = new FormData();
          document.querySelectorAll('form').forEach(element => {
            let data = new FormData(element);
            data = Object.fromEntries(data.entries())
            Object.keys(data).forEach((e) => {
              formdata.append(e, data[e])
            })
          });
          formdata = JSON.stringify(Object.fromEntries(formdata.entries()));

          // checking for that data in db

          $.ajax({
            type: "POST",
            url: url,
            data: formdata,
            dataType: "json",
            success: function (res) {
              console.log(res);
              let errors = { 'valid-username': 1, 'valid-email': 1, 'valid-first-name': 1, 'valid-last-name': 1, 'valid-phone': 1, 'username-exists': 1, 'email-exists': 1 }
              if ("success" in res) {
                Object.keys(errors).forEach(e => { $(`.${e}`).css("display:none") })
                $(".success").css("display", 'block')
                setTimeout(window.location.replace(`/${document.querySelector("#cwd").value}/public/admin/login`), 2000)
              }
              else {
                $(".success").css("display", 'none')
                let error = Object.keys(res);
                error.forEach(e => { $(`.${e}`).css('display', 'block') })
              }
              errors = ['valid-username', 'valid-email', 'username-exists', 'email-exists'];
              for (let i = 0; i < 4; i++) {
                if (errors[i] in res) { numberedStepper.previous(); break }
              }
            },
            error: function (XHRStatus) {
              console.log(XHRStatus.responseText)
            },
            complete: () => { btn.disabled = false; }
          });
        }
      });
  }

  // select2
  select.each(function () {
    var $this = $(this);
    $this.wrap('<div class="position-relative"></div>');
    $this.select2({
      // the following code is used to disable x-scrollbar when click in select input and
      // take 100% width in responsive also
      dropdownAutoWidth: true,
      width: '100%',
      dropdownParent: $this.parent()
    });
  });
  // multi-steps registration
  // --------------------------------------------------------------------
});
