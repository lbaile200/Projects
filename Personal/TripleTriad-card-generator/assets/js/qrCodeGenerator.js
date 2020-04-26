var debounceSearch = debounce(searchForPlayer, 400);
var qrcode = null;

function startUp() {
  $('#query').on('keydown input', debounceSearch);
  // var qrcode = new QRCode("qrcode", {
  //   text: "https://ork.amtgard.com/orkui/?Route=Player/index/43232",
  //   width: 100,
  //   height: 100
  // });
}

function hideSearch() {
  $('#playerBox').show();
  $('#backToSearch').show();
  $('.searchResults').hide();
  $('#search').hide();
  $('#copyToClipboard').show();
}

function showSearch() {
  $('#playerBox').hide();
  $('#backToSearch').hide();
  $('.searchResults').show();
  $('#search').show();
  $('#copyToClipboard').hide();
}

function backToSearch() {
location.reload();
return false;
  showSearch();
}
function getstats(mundaneId) {


  
}
function doPlayer(mundaneId, element) {
  var ParkName = element.children[2].textContent,
      KingdomName = element.children[3].textContent;

     /* lucas testing */
       //WARRIORS THIS WORKS FOR FLOOR AND CEILING
       jsork.player.getAwards(mundaneId, jsork.awardIDs.KNIGHT_OF_THE_SWORD).then(function(data) {
        if (data.length == 1) {
          warriors = "10";
        } else {
jsork.player.getAwards(mundaneId, jsork.awardIDs.ORDER_OF_THE_WARRIOR).then(function(data) {
       warriors = data.length;
       if (parseInt(warriors)<1){
         warriors = "1";
       } else if (parseInt(warriors)>10){
         warriors = "10";
       }
        }
        )
        }
});      //ROSES
jsork.player.getAwards(mundaneId, jsork.awardIDs.KNIGHT_OF_THE_FLAME).then(function(data) {
  if (data.length == 1) {
    roses = "10";
  } else {
jsork.player.getAwards(mundaneId, jsork.awardIDs.ORDER_OF_THE_ROSE).then(function(data) {
 roses = data.length;
 if (parseInt(roses)<1){
   roses = "1";
 } else if (parseInt(roses)>10){
   roses = "10";
 }
  }
  )
  }
});      //DRAGONS
jsork.player.getAwards(mundaneId, jsork.awardIDs.KNIGHT_OF_THE_SERPENT).then(function(data) {
  if (data.length == 1) {
    dragons = "10";
  } else {
jsork.player.getAwards(mundaneId, jsork.awardIDs.ORDER_OF_THE_DRAGON).then(function(data) {
 dragons = data.length;
 if (parseInt(dragons)<1){
   dragons = "1";
 } else if (parseInt(dragons)>10){
   dragons = "10";
 }
  }
  )
  }
});      //CROWNS
jsork.player.getAwards(mundaneId, jsork.awardIDs.KNIGHT_OF_THE_CROWN).then(function(data) {
  if (data.length == 1) {
    crowns = "10";
  } else {
jsork.player.getAwards(mundaneId, jsork.awardIDs.ORDER_OF_THE_LION).then(function(data) {
 //this works but makes 3 clicks...
  jsork.player.getAwards(mundaneId, jsork.awardIDs.ORDER_OF_THE_CROWN).then(function(data) {
  crownsSupplement = data.length;
   } );    
 crowns = data.length+parseInt(crownsSupplement);
 //stop
 if (parseInt(crowns+parseInt(crownsSupplement))<1){
   crowns = "1";
 } else if (parseInt(crowns+parseInt(crownsSupplement))>10){
   crowns = "10";
 }
  }
  )
  }
});
        //scope creep

        //creepy scope



 curve_test = (parseInt(warriors)+parseInt(crowns)+parseInt(dragons)+parseInt(roses));
 if (curve_test > 19){
  starRating = "&#9734"+"&#9734"+"&#9734";
} else if (curve_test <= 19 && curve_test > 10){
  starRating = "&#9734"+"&#9734";
} else if (curve_test <= 10){
  starRating = "&#9734";
}
if ( curve_test > 30){
curve = (curve_test - 30);
if (crowns < 10 && crowns > (curve+1)){
  crowns = parseInt(crowns)-curve;
}else if (warriors < 10 && warriors > (curve+1)){
  warriors = parseInt(warriors)-curve;
}else if (dragons < 10 && dragons >(curve+1)){
  dragons = parseInt(warriors)-curve;
}else if (roses < 10 && roses > (curve+1)){
  roses = parseInt(roses)-curve;
}
}

var anchorNorth = document.getElementById("anchor-north").innerHTML=warriors;
var anchorEast = document.getElementById("anchor-east").innerHTML=roses;
var anchorSouth = document.getElementById("anchor-south").innerHTML=dragons;
var anchorWest = document.getElementById("anchor-west").innerHTML=crowns;
var starRating = document.getElementById("star-rating").innerHTML=starRating;



/* this works.*/
/*
jsork.player.getAwards(26416, jsork.awardIDs.ORDER_OF_THE_CROWN).then(function(data){
console.log(data[0].Rank);}); 

where they have a rank defined for orders */

        
      
/* end testing */

  jsork.player.getInfo(mundaneId).then(function(player) {
    var playerDetails = player.Persona + '<br>' + '<br>' + ParkName + '<br>' + KingdomName + '<br>' + 'Reign 1';
    var playerImage = 'https://ork.amtgard.com/assets/heraldry/player/000000.jpg';
    if (player.HasImage) {
      playerImage = 'https:' + player.Image;
    }
    $('#playerImg').attr('src', playerImage);
    $('#playerDetails').html(playerDetails);
    /*if (!qrcode) {
      qrcode = new QRCode('qrcode', {
        text: 'https://ork.amtgard.com/orkui/index.php?Route=Player/index/' + player.MundaneId,
        width: 100,
        height: 100
      });
    } else {
      qrcode.makeCode('https://ork.amtgard.com/orkui/index.php?Route=Player/index/' + player.MundaneId);
    }
    */
    hideSearch();
  });
  curve_test = warriors+crowns+dragons+roses;
if (curve_test > 30){
curve = (curve_test - 30);
if (crowns < 10 && crowns > (curve+1)){
  crowns = parseInt(crowns)-curve;
}else if (warriors < 10 && warriors > (curve+1)){
  warriors = parseInt(warriors)-curve;
}else if (dragons < 10 && dragons >(curve+1)){
  dragons = parseInt(warriors)-curve;
}else if (roses < 10 && roses > (curve+1)){
  roses = parseInt(roses)-curve;
}
}
var anchorNorth = document.getElementById("anchor-north").innerHTML=warriors;
var anchorEast = document.getElementById("anchor-east").innerHTML=roses;
var anchorSouth = document.getElementById("anchor-south").innerHTML=dragons;
var anchorWest = document.getElementById("anchor-west").innerHTML=crowns;
}

function copyPlayerCard() {
  var node = document.getElementById('playerBox');

  domtoimage.toPng(node,{ height: 350 })
    .then(function (dataUrl) {
      copyImage(dataUrl);
      alert('Card is in clipboard');
    })
    .catch(function (error) {
      alert('An error occurred trying to copy the image');
    });
}

function copyImage(url){
  var img = new Image();
  img.src = url;
  var node = document.getElementById('playerBox');
  node.insertBefore(img, node.firstChild); //this may be useful --lucas
  var r = document.createRange();
  r.setStartBefore(img);
  r.setEndAfter(img);
  r.selectNode(img);
  var sel = window.getSelection();
  sel.removeAllRanges();
  sel.addRange(r);
  document.execCommand('Copy');
  node.removeChild(img);
}

function searchForPlayer() {
  var searchTerm = $('#query').val().trim();

  $('table').find('tr:gt(0)').remove();
  jsork.searchservice.searchPlayer(searchTerm.trim()).then(function(result) {
    var searchResults = result.sort(function(a, b) {
      var aPersona = a.Persona || '';
      var bPersona = b.Persona || '';
      return aPersona.localeCompare(bPersona);
    });
    searchResults.forEach(function(player) {
      var playerHTMLLine = '<tr onclick="doPlayer(' + player.MundaneId + ', this)">';
      playerHTMLLine = playerHTMLLine + '<td>' + player.Persona || '' + '</td>';
      playerHTMLLine = playerHTMLLine + '<td>' + player.UserName || '' + '</td>';
      playerHTMLLine = playerHTMLLine + '<td>' + player.ParkName || '' + '</td>';
      playerHTMLLine = playerHTMLLine + '<td>' + player.KingdomName || '' + '</td>';
      playerHTMLLine = playerHTMLLine + '</tr> ';
      $('#playerList').append(playerHTMLLine);
    });
    $('.working').attr('hidden', true);
    $('.searchResults').attr('hidden', false);
  });
}

function debounce(func, wait, immediate) {
  var timeout;
  return function() {
    var context = this, args = arguments;
    var later = function() {
      timeout = null;
      if (!immediate) func.apply(context, args);
    };
    var callNow = immediate && !timeout;
    clearTimeout(timeout);
    timeout = setTimeout(later, wait);
    if (callNow) func.apply(context, args);
  };
}

$(document).ready(function() {
  startUp();
})