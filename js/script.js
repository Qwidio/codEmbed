
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
  alerter("Copied to clipboard");
} 
