@if($cookieConsentConfig['enabled'] && ! $alreadyConsentedWithCookies)

    @include('cookie-consent::dialogContents')
@else
@include('cookie-consent::dialogShow')

@endif
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>

window.laravelCookieConsent = (function () {

    const COOKIE_VALUE = 1;
    const COOKIE_DOMAIN = '{{ config('session.domain') ?? request()->getHost() }}';

    function consentWithCookies() {
        //setCookie('{{ $cookieConsentConfig['cookie_name'] }}', COOKIE_VALUE, {{ $cookieConsentConfig['cookie_lifetime'] }});
        //hideCookieDialog();
    }

    function cookieExists(name) {
        return (document.cookie.split('; ').indexOf(name + '=' + COOKIE_VALUE) !== -1);
    }

    function hideCookieDialog() {
        const dialogs = document.getElementsByClassName('js-cookie-consent');

        for (let i = 0; i < dialogs.length; ++i) {
            dialogs[i].style.display = 'none';
        }
    }


    function showCookiesDialog() { 
        const dialogs = document.getElementsByClassName('js-cookie-consent');
        console.log(dialogs);
        for (let i = 0; i < dialogs.length; ++i) {
            dialogs[i].style.setProperty('display', 'block', 'important');  // Use this line if the above one doesn't work
        }  

        // for hidding current button
        const dialogsrevise = document.getElementsByClassName('js-cookie-consent-revise');
        console.log(dialogsrevise);
        for (let i = 0; i < dialogsrevise.length; ++i) {
            dialogsrevise[i].style.display = 'none';
        } 
    }

    function setCookie(name, value, expirationInDays) {  
        const date = new Date();
        date.setTime(date.getTime() + (expirationInDays * 24 * 60 * 60 * 1000));
        document.cookie = name + '=' + value
            + ';expires=' + date.toUTCString()
            + ';domain=' + COOKIE_DOMAIN
            + ';path=/{{ config('session.secure') ? ';secure' : null }}'
            + '{{ config('session.same_site') ? ';samesite='.config('session.same_site') : null }}';
    }
 
    
    if (cookieExists('{{ $cookieConsentConfig['cookie_name'] }}')) {
        //hideCookieDialog();
    }

    const buttons = document.getElementsByClassName('js-cookie-consent-agree');

    for (let i = 0; i < buttons.length; ++i) {
        buttons[i].addEventListener('click', consentWithCookies);

    }  



    //code for showing the prefereence
    const buttonsrevise = document.getElementsByClassName('js-cookie-consent-agree-revise');
    console.log(buttonsrevise);

    for (let i = 0; i < buttonsrevise.length; ++i) {
    buttonsrevise[i].addEventListener('click', showCookiesDialog);
    }  



    document.getElementById('cookie-consent-form').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const formData = new FormData(e.target);
            console.log(formData);
            const consents = {};



             // Get all checkboxes and set their values
             document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                const categoryId = checkbox.name.match(/\[(\d+)\]/)[1];
                consents[categoryId] = checkbox.checked;
            });
             
//             $("input[name='cookies[]']").each(function (index, obj) {
//     if ($(obj).prop('checked')) {  // Checks if the checkbox is selected
//         consents[index] = $(obj).val();

//     }
// });
console.log(consents);   



try {
                const response = await fetch('/consent/save', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({ consents })
                });
                if (response.ok) {
                    const result = await response.json();
                    console.log(result);

                    if (result.success) {
                        //window.location.reload();
                    }
                } else {
                    console.error('Failed to save preferences');
                }
            } catch (error) {
                console.error('Error saving preferences:', error);
            }



        });



    return {
        consentWithCookies: consentWithCookies,
        hideCookieDialog: hideCookieDialog,
        showCookiesDialog:showCookiesDialog
    };
})();
</script>