
function SetDialog(reqstate) {
    switch (reqstate) {
        case 'add':
            var adds = document.getElementById('add-dialog');
            if (adds) {
                adds.style.display = (adds.style.display === 'none' || adds.style.display === '') ? "flex" : "none";
            }
            break;
        case 'edit':
            var udt = document.getElementById('edit-dialog');
            if (udt) {
                udt.style.display = (udt.style.display === 'none' || udt.style.display === '') ? "flex" : "none";
            }
            break;
        case 'update':
            var udt = document.getElementById('update-dialog');
            if (udt) {
                udt.style.display = (udt.style.display === 'none' || udt.style.display === '') ? "flex" : "none";
            }
            break;
        default:
        return;
    }
};

function copy(id) {
  var copyText = document.getElementById(id);
  copyText.select();
  copyText.setSelectionRange(0, 99999);
  navigator.clipboard.writeText(copyText.value);
  alerter("Code copied to clipboard");
} 
function share(shareCode) {
  navigator.clipboard.writeText(shareCode);
  alerter("Link copied to clipboard");
} 
document.addEventListener("DOMContentLoaded", function() {
    const borderAnimate = document.getElementById('borderanimate');
    setTimeout(() => {
        borderAnimate.style.animation = 'none';
        void borderAnimate.offsetWidth;
        borderAnimate.style.animation = 'ReverseTimer';
    }, 100);
});
function alerter(content) {
    const alertcard = document.getElementById('alertcard');
    const alertcontent = document.getElementById('alertcontent');
    alertcontent.textContent = content;
    setTimeout(() => {
        alertcard.style.transform = "translateX(0)";
    }, 100);
    setTimeout(() => {
        alertcard.style.transform = "translateX(100vw)";
    }, 5000);
};
