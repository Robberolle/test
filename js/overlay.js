
function overlay() {

    var $overlay;

    var toggleOverlay = function toggleOverlay() {
        $overlay.toggle();
        $overlay.css('marginTop', $(window).scrollTop());
        var overlayVisible = $overlay.css('display') !== 'none';
        if (overlayVisible) {
            disableScrolling();
            enableArrows();
        } else {
            enableScrolling();
            disableArrows();
        }
    };

    var setNewOverlayImage = function setNewOverlayImage(src) {
        $overlay.find('img').attr('src', '');
        $overlay.find('img').attr('src', src);
    };

    var imageclickHandler = function imageclickHandler(event) {
        var $img = $(event.target);
        setNewOverlayImage($img.attr('data-originsrc'));
        toggleOverlay();
    };

    var arrowclickHandler = function arrowclickHandler(event) {
        var arrow = $(event.target);
        //console.log(arrow);
        var activebutton = $('button.active');
        var abid = activebutton[0].id;
        //console.log(abid);
        if(abid == 'ordner1'){
            var imageGrid = $('#image-grid0 > .image-container');

        }
        else if(abid == 'ordner2'){
            var imageGrid = $('#image-grid1 > .image-container');
        }  
        //console.log(imageGrid);
        var currentImg = $overlay.find('img').attr('src');
        //console.log(currentImg);
        for(i = 0; i < imageGrid.length; i++){
            if(currentImg == imageGrid[i].children[0].dataset.originsrc){
                if(arrow[0].className == 'arrow right'){
                    if(i == imageGrid.length-1){
                        j = 0;
                        var prevImgsrc = imageGrid[j].children[0].dataset.originsrc;
                    }
                    else{
                        var prevImgsrc = imageGrid[i].nextSibling.children[0].dataset.originsrc;                     
                    }
                    setNewOverlayImage(prevImgsrc);
                }
                else if(arrow[0].className == 'arrow left'){
                    if(i == 0){
                        j = imageGrid.length-1;
                        var nextImgsrc = imageGrid[j].children[0].dataset.originsrc;
                    }
                    else{
                        var nextImgsrc = imageGrid[i].previousSibling.children[0].dataset.originsrc;                        
                    }
                    setNewOverlayImage(nextImgsrc);        
                }
            }
        }
    }

    var buttonclickHandler = function buttonclickHandler(event){
        var button = $(event.target);
        //console.log(button);
        if(button[0].id == "ordner1"){
            $('#image-grid0').css({display:'block'});
            $('#image-grid1').css({display:'none'});
            $('#ordner1').attr('class', 'active');
            $('#ordner2').attr('class', '');
        }
        else if(button[0].id == "ordner2"){
            $('#image-grid0').css({display:'none'});
            $('#image-grid1').css({display:'block'});
            $('#ordner1').attr('class', '');
            $('#ordner2').attr('class', 'active');
        }
        else if(button[0].id == "remove1"){
        
            var path1 = 'img/images/480/clif.jpg';
            var path2 = 'img/images/clif.jpg';

            //function windowSize(){
            url = 'deleteFile.php';
            $.ajax({
                type:'POST', 
                url: url, 
                data:{ 
                    path1: path1,
                    path2: path2
                },
                success: function(data, status){
                    $('#image-grid0').load('generateImages.php #image-grid0');
                },dataType: 'html'
            });
            
        }
    }

    var disableScrolling = function disableScrolling() {
        $('html').css({
            overflow: 'hidden',
            height: '100%'
        });
    };

    var enableScrolling = function enableScrolling() {
        $('html').css({
            overflow: 'auto',
            height: 'auto'
        });
    };

    var disableArrows = function disableArrows(){
        $('.arrow').css({display:'none'});
    }

    var enableArrows = function enableArrows(){
        $('.arrow').css({display:'inline-block'});
    }

    var init = function init() {
        $overlay = $('.overlay');
        $('.image-container').on('click', imageclickHandler);
        $('.arrow').on('click',arrowclickHandler);
        $('button').on('click',buttonclickHandler);
        $overlay.on('click', toggleOverlay);
    };

    

    init();
}

//overlay();
