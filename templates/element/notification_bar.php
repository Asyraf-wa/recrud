  <div class="notification py-2" role="notification">
    <div style="margin-bottom: -1rem;"><?php echo $notification; ?></div>
    <button>
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><title>close</title><g fill="none"><path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.25 6.75l-10.5 10.5"></path><path stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6.75 6.75l10.5 10.5"></path></g></svg>
    </button>
  </div>
  <script>
    const notification = document.querySelector('.notification');
const dismissAlertButton = document.querySelector('.notification button');

if (localStorage.getItem('hideNotification')) {
  notification.style.display = "none";
}

if (dismissAlertButton) {
  dismissAlertButton.addEventListener('click', event => {
    event.preventDefault();
    notification.classList.add('notification-hidden');
    localStorage.setItem("hideNotification", true);
  })
}

var hours = 1; // to clear the localStorage after 1 hour
var now = new Date().getTime();
var setupTime = localStorage.getItem('setupTime');
if (setupTime == null) {
    localStorage.setItem('setupTime', now)
} else {
    if(now-setupTime > hours*60*60*1000) {
        localStorage.clear()
        localStorage.setItem('setupTime', now);
    }
}
  </script>