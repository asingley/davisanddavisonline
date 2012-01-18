		window.onload=fLoad;
		var i1=new Image();var i2=new Image();var i3=new Image();
		var i4=new Image();var i5=new Image();var i6=new Image();
		var i7=new Image();var i8=new Image();var i9=new Image();
		var i10=new Image();var i11=new Image();var i12=new Image();
		var i13=new Image();var i14=new Image();var i15=new Image();
		var i16=new Image();var i17=new Image();
		var bMailerClick=0;
		var timer;
		
		function fLoad(){
			i1.src='images/oilshot.jpg';i2.src='images/dippershot.jpg';i3.src='images/frozenshot.jpg';
			i4.src='images/jamshot.jpg';i5.src='images/mustardshot.jpg';i6.src='images/relishshot.jpg';
			i7.src='images/salsashot.jpg';i8.src='images/samplershot.jpg';i9.src='images/menu.jpg';
			i10.src='images/cheeseshot.jpg';i11.src='images/bloodymaryshot.jpg';i12.src='images/kensstuffshot.jpg';
			i13.src='images/lulushot.jpg';i14.src='images/bbbshot.jpg';i15.src='images/razzleshot.jpg';
			i16.src='images/soupshot.jpg';
			i17.src='images/vanillashot.jpg';
			fLoadHTML();
		}
		
		function fLoadHTML(){
			var strURL=new String(location.href);
			if(strURL.indexOf('start.htm')==-1){
				document.getElementById('footerAll').innerHTML='\
					<div class=\"purpBar\">\
						<img src=\"images/purplefadebar.jpg\" alt=\"Davis And Davis\" />\
					</div>\
					<div id=\"footer\">\
						<span class=\"smallText\"><a href=\"about.htm\">About</a></span>\
						<span class=\"smallText\"><a href=\"contact.htm\">Contact</a></span>\
						<span class=\"smallText\"><a href=\"relations.htm\">Customer Relations</a></span>\
						<span class=\"smallText\"><a href=\"mailto:feedback02@davisanddavisonline.com\">Feedback</a></span>\
						<span class=\"smallText\"><a href=\"policies.htm\">Policies</a></span>\
					</div>\
					<div id=\"note\">\
						&copy;2012 Davis &amp; Davis Gourmet Foods<br />\
						Web Design: <a href=\"http://www.MediaSiteDesign.com\" target=\"_blank\">Media Site Design</a>\
					</div>\
					<form id=\"fm\" action=\"http://www.davisanddavisonline.com/cgi-davisanddavisonline/sb/order.cgi\" method=\"post\">\
					<input id=\"storeid\" name=\"storeid\" type=\"hidden\" value=\"\" />\
					<input id=\"super\" name=\"super\" type=\"hidden\" value=\"\" />\
					<input id=\"dbname\" name=\"dbname\" type=\"hidden\" value=\"\" />\
					<input id=\"function\" name=\"function\" type=\"hidden\" value=\"\" />\
					<input id=\"itemnum\" name=\"itemnum\" type=\"hidden\" value=\"\" />\
					</form>\
				';
			}
		}
		
		function fMenuOver(){
			clearTimeout(timer);
		}
		
		function fMenuOut(){
			timer=setTimeout('fHideSub()',1000);
		}
		
		function fClearMailer(xObj){
			if(bMailerClick!=1){
				xObj.value="";
			}
			bMailerClick=1;
		}
		
		function fPanelClick(){
			location='sampler.htm';
		}
		
		function fShowSub(id){
			var obj=document.getElementById(id);
			if(obj.style.display=='block'){
				//obj.style.display='none';
			}else{
				obj.style.display='block';
			}
		}
		function fHideSub(){
			try{
				document.getElementById('menuSub1').style.display='none';
			}catch(err){
				//
			}
		}
		function fMoneyShot(num){
			var obj=document.getElementById('imgShot');
			switch(num){
				case 1:
					obj.src=i1.src;break;
				case 2:
					obj.src=i2.src;break;
				case 3:
					obj.src=i3.src;break;
				case 4:
					obj.src=i4.src;break;
				case 5:
					obj.src=i5.src;break;
				case 6:
					obj.src=i6.src;break;
				case 7:
					obj.src=i7.src;break;
				case 8:
					obj.src=i8.src;break;
				case 10:
					obj.src=i10.src;break;
				case 11:
					obj.src=i11.src;break;
				case 12:
					obj.src=i12.src;break;
				case 13:
					obj.src=i13.src;break;
				case 14:
					obj.src=i14.src;break;
				case 15:
					obj.src=i15.src;break;
				case 16:
					obj.src=i16.src;break;
				case 17:
					obj.src=i17.src;break;
			}
			
			document.getElementById('moneyShot').style.visibility='visible';
		}
		function fMoneyOut(){
			document.getElementById('moneyShot').style.visibility='hidden';
		}
		
		function fAddItem(prod){
			var xItemNum=document.getElementById('selOpt').value;
			var xStoreID='';
			var xSuper='';
			var strDBName='products';
			var strFunction='add';

			switch(prod){
				case 'vanilla':
					xStoreID='*30b3740ec644d5688492bfa5900499e5a67c8e4df6afa904c308';
					break;
				case 'soup':
					xStoreID='*2e26ade564a0b3a84b3bff8b50470e7f67f8e349a79dacc423';
					break;
				case 'oil':
					xStoreID='*320356ef48d9ab25e5b8fbc2c205740ecfe0b8f6c3947a4ad64a4a';
					break;
				case 'dip':
					xStoreID='*2e26ade564a0b3974cb83f8b50460eff67f8e349a79dacc4fb';
					break;
				case 'drink':
					xStoreID='*2aa2a63bd796415e00ee584f06be74f28094cd3acfa4b7';
					break;
				case 'jam':
					xStoreID='*2e26ade564a0b3c54739ef8b50470e8f67f8e349a79dacc4ce';
					break;
				case 'must':
					xStoreID='*320356ef48d9ab2575eb4bb6cde6740ecfe0a8f6c3947a4ad64a81';
					break;
				case 'rel':
					xStoreID='*2c6b75eda43e6250ebf983e4f06ef74f4d08ccaa499b4abe';
					break;
				case 'salsa':
					xStoreID='*36f8402365daae53d82e3ef983ae96eb49c0f6ff70873ad2b644a9c42f';
					break;
				case 'samp':
					xStoreID='*3485e35df4aa6ebd9573246d06b04740c9fe0d8a6fd396247ce44a5e';
					break;
				case 'cheese':
					xStoreID='*320356ef48d9ab2f85893bf52e19740ecfe0a8f6c3947a4ad64afe';
					break;
				case 'bloody':
					xStoreID='*2c6b75eda43b6250b58983e4f06ef74f5d08ccaa499b4a5e';
					break;
				case 'lulu':
					xStoreID='*2e26ade564a0b39d45731f8b50470eaf67f8e349a79dacc4c4';
					break;
				case 'razzle':
					xStoreID='*3485e35df4aa6dbd9134c25009b8e740c9fe0c8a6fd396247ce44a8b';
					break;
			}
			
		
			document.getElementById('storeid').value=xStoreID;
			document.getElementById('super').value=xSuper;
			document.getElementById('dbname').value=strDBName;
			document.getElementById('function').value=strFunction;
			document.getElementById('itemnum').value=xItemNum;
			
			document.getElementById('fm').submit();
		}
		
		function fAddCheese(xItemNum){
			var xStoreID='*320356ef48d9ab2f85893bf52e19740ecfe0a8f6c3947a4ad64afe';
			var xSuper='';
			var strDBName='products';
			var strFunction='add';
			
			document.getElementById('storeid').value=xStoreID;
			document.getElementById('super').value=xSuper;
			document.getElementById('dbname').value=strDBName;
			document.getElementById('function').value=strFunction;
			document.getElementById('itemnum').value=xItemNum;
			
			document.getElementById('fm').submit();
		}

		function fAddBloody(xItemNum){
			var xStoreID='*2c6b75eda43b6250b58983e4f06ef74f5d08ccaa499b4a5e';
			var xSuper='';
			var strDBName='products';
			var strFunction='add';
			
			document.getElementById('storeid').value=xStoreID;
			document.getElementById('super').value=xSuper;
			document.getElementById('dbname').value=strDBName;
			document.getElementById('function').value=strFunction;
			document.getElementById('itemnum').value=xItemNum;
			
			document.getElementById('fm').submit();
		}

		function fAddK(xItemNum){
			var xStoreID='*3485e35df4aa6dbd9134c25009b8e740c9fe0c8a6fd396247ce44a8b';
			var xSuper='';
			var strDBName='products';
			var strFunction='add';
			
			document.getElementById('storeid').value=xStoreID;
			document.getElementById('super').value=xSuper;
			document.getElementById('dbname').value=strDBName;
			document.getElementById('function').value=strFunction;
			document.getElementById('itemnum').value=xItemNum;
			
			document.getElementById('fm').submit();
		}
		
		