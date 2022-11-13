(function (window, undefined) {
  'use strict';

  $("input[name='quantity']").TouchSpin({
    min: 1,
    max: 10000000000000000n,
    step: 1,
    maxboostedstep: 5,
  })
  $("input[name='price']").TouchSpin({
    min: 0.1,
    max: 100000000000,
    maxboostedstep: 5,
  })
  $("input[name='discount']").TouchSpin({
    min: 0,
    max: 100,
    step: 1,
    maxboostedstep: 5,
  })
})(window);
