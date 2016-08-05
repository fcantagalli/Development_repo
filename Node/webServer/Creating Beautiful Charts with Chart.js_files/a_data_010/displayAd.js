var e9Manager;
var e9;
var expoDisplayAd = (function() {
   var init = {
      fetchAd: function() {
         e9Manager.setTKey("ajmneM3rn4VFMCW6M4RT323UQGS5ot6Y");
         if (e9 !== undefined)
          {
            if (e9.displayAdFlag !== undefined)
             {
               if (e9.displayAdFlag === true)
                  e9.displayAd();
             }
	    else
             {
               e9Manager.displayAdFromE9(e9);
             }
          }
	 else
	  {
            e9Manager.fetchAds();
          }
       }
    }

   return init;
})();

expoDisplayAd.fetchAd();
