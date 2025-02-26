function addError(elem_name,text)
{
    elem = $('[name=' + elem_name + ']');
    coor = elem.offset();
    id = 'err' + Math.round(Math.random()*1000)
    $('body').append('<div class=form_error id=' + id + ' data-input=' + elem_name +'><div class=rect></div><div class=text>' + text + '</div></div>')
    $('#' + id).css({
        'left':coor.left + $(elem).width() + 40,
        'top':coor.top
    }).show()
}

function changeTimeLeft()
{                
    $('#time_left').text(formatTimeLeft());
    timeleft--;
    if ( timeleft < 1 ) {
        window.location.href = window.location.href;
    }
}
                                                                                                                                                                                                                        
function formatTimeLeft()
{
    time = "";
    day = Math.floor(timeleft/(24*60*60));
    if ( day >= 2 ) {
        time = day + ' Days ';
    } else if(day == 1 ) {
        time = day + ' Day ';
    }
                                                                                                                                                                                                                            
    hour = Math.floor(timeleft/(60*60)) - day*24;
    if ( hour >= 2 ) {
        time += hour + ' Hours ';
    } else if(hour == 1 ) {
        time += hour + ' Hour ';
    }
                                                                                                                                                                                                                            
    minute = Math.floor(timeleft/(60)) - day*24*60 - hour*60;
    if ( minute >= 2 ) {
        time += minute + ' Minutes ';
    } else if(minute == 1 ) {
        time += minute + ' Minute ';
    }
                                                                                                                                                                                                                            
    second = timeleft - day*24*60*60 - hour*60*60 - minute*60;
    if ( second >= 2 ) {
        time += second + ' Sec ';
    } else if(second == 1 ) {
        time += second + ' Sec ';
    }
                                                                                                                                                                                                                                
    return time;
}
        
        
$(document).ready(function(){
    page = document.location.pathname.replace('/members','')
    if(page=='' || page=='/'){
        $('.menu li a:contains("Home")').parent().addClass('active').parent().show()
    } else {        
        $('.menu li a[href$="' + page + '"]').parent().addClass('active').parent().show()
    }
    
    //Spotlight Ads
    $('.spotlights .slide_right').click(function(){
        $('.ads .ad:first').animate({
            'marginLeft' : '-' + ($('.ads .ad:first').width() + 20) + 'px'
        },600,function(){
            $(this).remove().appendTo('.spotlights .wr').css('marginLeft','8px')
        })
    })
    
    $('.spotlights .slide_left').click(function(){
        $('.ads .ad:last').remove().prependTo('.spotlights .wr').css('marginLeft','-' + ($('.ads .ad:first').width() + 20) + 'px');
        
        $('.ads .ad:first').animate({
            'marginLeft' : '8px'
        },600)
    })
    
    //Новости
    $('.news .down').click(function(){
        $('.news .wr .item:first').animate({
            'marginTop' : '-' + ($('.news .wr .item:first').height() ) + 'px'
        },300,function(){
            $(this)
            .remove()
            .appendTo('.news .wr')
            .css('marginTop','8px')
        })
    })
    
    $('.news .up').click(function(){
        $('.news .wr .item:last')
        .remove()
        .prependTo('.news .wr')
        .css('marginTop', '-' + ($('.news .wr .item:last').height() + 8) + 'px');
                    
        $('.news .wr .item:first').animate({
            'marginTop' : '0px'
        },300)
        
    })
    
    var menu_opened = false;
    $('.menu_button').click(function(){
        if(!menu_opened) {
            $('.content > .sidebar > .menu').slideDown()
        } else {
            $('.content > .sidebar > .menu').slideUp()
        }
        menu_opened = !menu_opened;
    })
    
    $('.content > .sidebar > .menu > li > a').click(function(){
        $('.content > .sidebar > .menu ul').slideUp()
        $(this).next('ul').slideDown();
    })
    
    
    
    $('.menu li').mouseenter(function(){
        $('.menu li').removeClass('active')
    })
    
    //для автосабмита форм кнопками
    $('[data-submit]').click(function(){
        form = $(this).attr('data-submit');
        $('.' + form).submit();
    })
})
