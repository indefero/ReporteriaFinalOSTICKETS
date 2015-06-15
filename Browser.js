
//funcion para validar el tipo de browser para indicar que browser esta usando
function Browser() {   
     this.init = function() { //busca que tipo de browser esta usando antes de asignar el  chrome 
        var navs = [
            { name:'Opera Mobi', fullName:'Opera Mobile', pre:'Version/' },
            { name:'Opera Mini', fullName:'Opera Mini', pre:'Version/' },
            { name:'Opera', fullName:'Opera', pre:'Version/' },
            { name:'MSIE', fullName:'Microsoft Internet Explorer', pre:'MSIE ' },  
            { name:'BlackBerry', fullName:'BlackBerry Navigator', pre:'/' }, 
            { name:'BrowserNG', fullName:'Nokia Navigator', pre:'BrowserNG/' }, 
            { name:'Midori', fullName:'Midori', pre:'Midori/' }, 
            { name:'Kazehakase', fullName:'Kazehakase', pre:'Kazehakase/' }, 
            { name:'Chromium', fullName:'Chromium', pre:'Chromium/' }, 
            { name:'Flock', fullName:'Flock', pre:'Flock/' }, 
            { name:'Galeon', fullName:'Galeon', pre:'Galeon/' }, 
            { name:'RockMelt', fullName:'RockMelt', pre:'RockMelt/' }, 
            { name:'Fennec', fullName:'Fennec', pre:'Fennec/' }, 
            { name:'Konqueror', fullName:'Konqueror', pre:'Konqueror/' }, 
            { name:'Arora', fullName:'Arora', pre:'Arora/' }, 
            { name:'Swiftfox', fullName:'Swiftfox', pre:'Firefox/' }, 
            { name:'Maxthon', fullName:'Maxthon', pre:'Maxthon/' },
            // { name:'', fullName:'', pre:'' } //add new broswers
            // { name:'', fullName:'', pre:'' }
            { name:'Firefox',fullName:'Mozilla Firefox', pre:'Firefox/' },
            { name:'Chrome', fullName:'Google Chrome', pre:'Chrome/' },
            { name:'Safari', fullName:'Apple Safari', pre:'Version/' }
        ];
    
      var agent = navigator.userAgent, pre;
        //set names
        for (i in navs) {
           if (agent.indexOf(navs[i].name)>-1) {
               pre = navs[i].pre;
               this.name = navs[i].name.toLowerCase(); //the code name is always lowercase
               this.fullName = navs[i].fullName; 
                if (this.name=='msie') this.name = 'iexplorer';
                if (this.name=='opera mobi') this.name = 'opera';
                if (this.name=='opera mini') this.name = 'opera';
                break; //when found it, stops reading
            }
        }//for
        
      
    };//function
    
    this.init();

}//Browser class