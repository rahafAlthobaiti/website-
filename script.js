//1   
function toggleTheme() {        // وظيفة تبديل الثيم (الوضع الليلي/النهاري)
    document.body.classList.toggle('light-mode');
}
//2
let mybutton = document.getElementById("scrollTopBtn"); //يخزن الزر في متغير

window.onscroll = function () {  //يتم استدعاء الدالة عند تمرير الصفحة
    scrollFunction();
};
function scrollFunction() {  //يظهر الزر لمن ننزل اكثر من 200بكسل - اذا اقل يختفي الزر
    if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
        mybutton.style.display = "block";
    } else {
        mybutton.style.display = "none";
    }
}
function topFunction() { // عند الضغط على الزر ترجع الصفحة للاعلى
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
//3
//login -log up //أسناد العناصر في متغيرات
const loginModal = document.getElementById('loginModal');
const loginForm = document.getElementById('loginForm');
const registerForm = document.getElementById('registerForm');
const showRegister = document.getElementById('showRegister');
const showLogin = document.getElementById('showLogin');
const closeBtn = document.querySelector('.close-btn');

// فتح النافذة (لمن نضغط على تسجيل دخول)
function openLoginModal() {
    loginModal.style.display = 'block';
}
//اغلاق النافذة(لمن نضغط x)
closeBtn.onclick = function () {
    loginModal.style.display = 'none';
}
// التبديل بين تسجيل الدخول والتسجيل
showRegister.onclick = function (e) { // نموذج التسجيل
    e.preventDefault();
    loginForm.style.display = 'none';  //عند الضغط على (سجل الان)يخفي نموذج تسجيل الدخول ويظهر نموذج التسجيل
    registerForm.style.display = 'block';
}
showLogin.onclick = function (e) {  //نموذج الدخول
    e.preventDefault();
    registerForm.style.display = 'none';  //عند الضغط على(سجل دخول)يعود لنموذج تسجيل الدخول 
    loginForm.style.display = 'block';
}
// إغلاق النافذة عند النقر خارجها
window.onclick = function (e) {
    if (e.target == loginModal) {
        loginModal.style.display = 'none';
    }
}

// بعد تسجيل الدخول الناجح
localStorage.setItem('isLoggedIn', 'true'); //يخزن تسجيل الدخول في التخزين المحلي للمتصفح
//ارسال البيانات
fetch('/login', {      //ارسال البريد وكلمة المرور الى السيرفر
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify({ email, password })
})
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // تسجيل دخول ناجح
        }
    });
