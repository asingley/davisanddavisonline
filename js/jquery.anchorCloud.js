/**
* jQuery LinkColor Plugin 1.0
*
* http://www.9lessons.info/
* 
* Copyright (c) 2011 Arun Kumar Sekar 
*/
(function($){ 
 
    // Done by ArunKumar Sekar
   
    $.fn.anchorCloud = function(options){
   	
        $this = $(this);
   	
        var anchors = "";
        var ids = "";
        var chk = "";
        var cache = [];
        var selectors = "";        
		
        var opts = $.extend({}, $.fn.anchorCloud.defaults, options);   	
   	
        return $this.each(function(i,obj){
   		
            anchors = $(obj).find("a").get();
            selectors = $this.selector.replace("#","");
            var o = $.meta ? $.extend({}, opts, $this.data()) : opts;

            $.each(anchors, function(j, anc){

                $description = $('<div/>').addClass('anchorDescription').css({
                    'font-size':'12px',
                    'color':o.description_color,
                    'padding':'0',
                    'margin':'5px'
                });

                $title = $('<div/>').addClass('anchorTitle').css({
                    'font-size':'14px',
                    'font-weight':'bold',
                    'color':o.title_color,
                    'padding':'0',
                    'margin':'5px'
                }).after($description);
				
                $arrow = $('<span/>').css({
                    'border-bottom':'7px solid '+o.background,
                    'border-left':'7px solid transparent',
                    'border-right':'7px solid transparent',
                    'height':'0',
                    'width':'0',
                    'position':'absolute',
                    'top':'-7px',
                    'left':'2px'
                }).addClass('upArrow');

                $append = $("<div/>").css({
                    'border':'1px solid '+o.background,
                    'position':'absolute',
                    'width':'250px',
                    'font-size':'10px',
                    'height':'auto',
                    'background-color':o.background,
                    'padding':'3px',
                    'margin':'0',
                    'left':'100px',
					'font-family':'arial',
					'box-shadow': '0px 4px 5px #AAAAAA'
                }).addClass('ancSite').html($title.before($arrow));	// Append popup div
				
                $(anc).bind("mouseover", function(e){
					var anchorPosition = $(this).position();					
                    var page_x = Math.round(anchorPosition.left+5);
                    var page_y = Math.round(anchorPosition.top+25);
                    //alert(page_x);
                    $append.css({
                        'left':(page_x)+"px",
                        'top':(page_y)+"px"
                    });
                    $link = $(this).attr('href');
                    ids = $link.replace(/[^a-zA-Z 0-9]+/g,"");
                    ids += "_"+selectors;
                    if($link.search("youtu") != -1){
                        if($link.search("v=") != -1)
                            var yarr = $link.split("=");
                        else
                            var yarr = $link.split("be/");
                        var videoFormat = '<center><iframe width="250" height="157" src="http://www.youtube.com/embed/'+yarr[1]+'" frameborder="0"></iframe></center>';
                        $append.find('.anchorDescription').html("<center>"+o.loading_text+"</center>");
                    }else if($link.search("vimeo") != -1){
                        var yarr = $link.split("com/");
                        var videoFormat = '<center><iframe src="http://player.vimeo.com/video/'+yarr[1]+'?title=0&amp;byline=0&amp;portrait=0" width="250" height="141" frameborder="0"></iframe></center>';
                    }
                    if(cache[ids]==undefined){
                        var prsUrl = "http://query.yahooapis.com/v1/public/yql?q=";
                        var yql = "select * from html where url=\""+$link+"\" and (xpath='//meta[@name=\"description\"]' or xpath='//title')";
                        var url = prsUrl+encodeURI(yql)+"&format=json";
                        $append.find('.anchorDescription').html("<center>"+o.loading_text+"</center>");
                        $append.find('.anchorTitle').html("");
                        $.getJSON(url,function(data){
                            var items = [];
                            $.each(data, function(key,value){
                                items[key] = value;
                            });
                            if(items)
                            {
                                var tit = items['query']['results']['title'];
                                var des = items['query']['results']['meta']['content'];
                                $append.attr('id', ids);
                                if(tit)
                                {
                                    											
                                    $this.find('.anchorTitle').html(tit);
                                    if(videoFormat){
                                        $this.find('.anchorDescription').html(videoFormat);
                                        cache[ids] = Array(tit, videoFormat);
                                    }else{
                                        $this.find('.anchorDescription').html(des);
                                        cache[ids] = Array(tit, des);
                                    }
                                }
                                else
                                {
                                    var nomsg = "<center style='"+o.title_color+"'>No data available</center>";
                                    cache[ids] = Array("", nomsg);
                                    $this.html(nomsg);
                                }
                            }
                        });
                        $(anc).css('color',o.anchor_hover_color).after($append.show());
                    }else{
                        $this.find('.anchorTitle').html(cache[ids][0]);
                        $this.find('.anchorDescription').html(cache[ids][1]);
                        $(anc).css('color','red').after($append.show());
                    }
					
                }).mouseout(function(){
                    $(this).css('color',o.anchor_default_color);
                //$(".ancSite").hide();
                });	// even
            });
            $(document).click(function(event){
                if($(event.target).hasClass('ancSite') == false)
                    $(".ancSite").fadeOut();                
            });
        });	// Main Function
    }
   
    $.fn.anchorCloud.defaults = {
        background : "#e4e4e4",
        title_color : "#333333",
        loading_text : "Fetching data ...",
        description_color : "#666666",
        anchor_default_color : "#006699",
        anchor_hover_color:"#006699",
		
		
    };
   
})(jQuery);
