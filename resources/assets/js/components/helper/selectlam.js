
export function select_lam() {
    $('#manv').click(function () {
        $('.body-select-lam').css('display','block');
    });
    var lam2 = document.getElementById("manv");
    var lam = document.querySelector("#manv .body-select-lam")
    lam.style.display = 'block';

    var option = document.querySelector("#manv .body-select-lam select option");
    option.onclick = function() {
        lam.style.display = 'none';
    }
    window.onclick = function(event) {
        console.log(event.target);
        if(event.target == lam || event.target == lam2){
            lam.style.display = 'block';
        }
        else{
            lam.style.display = 'none';
        }
    }
}