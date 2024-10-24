(function (factory) {
  if (typeof define === 'function' && define.amd) {
    define(['jquery', '../jquery.validate'], factory);
  } else if (typeof module === 'object' && module.exports) {
    module.exports = factory(require('jquery'));
  } else {
    factory(jQuery);
  }
})(function ($) {
  /*
   * Translated default messages for the jQuery validation plugin.
   * Locale: Hindi; हिंदी
   */
  $.extend($.validator.messages, {
    required: 'आवश्यक फ़ील्ड।',
    remote: 'इस फ़ील्ड को जांचें।',
    email: 'एक वैध ई - मेल पते की प्रविष्टि करें।',
    url: 'कृपया एक वैध वेब पता दर्ज करें।',
    date: 'कृपया कोई मान्य दिनांक दर्ज करें।',
    dateISO: 'कृपया एक मान्य दिनांक (ISO) दर्ज करें।',
    number: 'कृपया सही अंक दर्ज करें।',
    digits: 'केवल संख्याएं दर्ज करें।',
    creditcard: 'कृपया एक वैध क्रेडिट कार्ड नंबर डालें।',
    equalTo: 'मेल नहीं खाता।',
    extension: 'कृपया एक मान्य एक्सटेंशन वाला मान दर्ज करें।',
    maxlength: $.validator.format('अधिक दर्ज न करें {0} वर्णों में से'),
    minlength: $.validator.format('कृपया कम से कम {0} वर्ण दर्ज करें।'),
    rangelength: $.validator.format(
      'कृपया {0} और {1} वर्णों के बीच एक मान दर्ज करें।'
    ),
    range: $.validator.format('कृपया {0} और {1} के बीच एक मान दर्ज करें।'),
    max: $.validator.format('कृपया {0} से कम या उसके बराबर मान दर्ज करें।'),
    min: $.validator.format('कृपया {0} से अधिक या उसके बराबर मान दर्ज करें।'),
    nieES: 'कृपया एक मान्य NIE दर्ज करें।',
    cifES: 'कृपया एक मान्य CIF दर्ज करें.',
    currency: 'कृपया एक मान्य मुद्रा दर्ज करें।.',
    step: $.validator.format('{0} का गुणज होना चाहिए।'),
    abaRoutingNumber: 'कृपया एक मान्य रूटिंग नंबर दर्ज करें।',
    accept: 'कृपया एक मान्य माइमटाइप वाला मान दर्ज करें।',
    alphanumeric: 'कृपया, केवल अक्षर, संख्याएं और अंडरस्कोर।',
    bankaccountNL: 'कृपया एक वैध बैंक खाता संख्या निर्दिष्ट करें।',
    bankorgiroaccountNL:
      'कृपया एक वैध बैंक या जीरो खाता संख्या निर्दिष्ट करें।',
    bic: 'कृपया कोई मान्य BIC कोड निर्दिष्ट करें।',
    ziprange: 'आपका ज़िप कोड 902xx-xxxx से 905xx-xxxx की सीमा में होना चाहिए।',
    zipcodeUS: 'निर्दिष्ट यूएस ज़िप कोड अमान्य है।',
    vinUS: 'निर्दिष्ट वाहन पहचान संख्या (VIN) अमान्य है।',
    time12h: 'कृपया 12 घंटे पूर्वाह्न/अपराह्न प्रारूप में मान्य समय दर्ज करें।',
    time: 'कृपया 00:00 और 23:59 के बीच एक वैध समय दर्ज करें।',
    strippedminlength: 'कृपया कम से कम {0} वर्ण दर्ज करें।',
    stateUS: 'कृपया एक वैध प्रदेश निर्दिष्ट करें।',
    skip_or_fill_minimum:
      'कृपया या तो इन फ़ील्ड को छोड़ दें या उनमें से कम से कम {0} भरें।',
    require_from_group: 'कृपया इनमें से कम से कम {0} को भरें।',
  });
  return $;
});
