 var i = 0;

  function increment(){
    i+= 1;
  }

  function removeElement(parentDiv,childDiv){
    var child = document.getElementById(childDiv);
    var parent = document.getElementById(parentDiv);
    parent.removeChild(child);
    i -= 1;
  }


  function addAuthor(){
    
    var div = document.createElement('div');

    div.setAttribute("class","entry input-group col-xs-3");

    var y = document.createElement('INPUT');

    y.setAttribute("type","text");
    y.setAttribute("class","input form-control");
    y.setAttribute("placeholder","Enter Another Author");
    increment();
    y.setAttribute("name","author[" + i + "]");
    div.setAttribute("id","author_div_" + i);

    var button = document.createElement("Button");
    button.setAttribute("class","btn btn-danger btn-add");
    button.setAttribute("type","button");
    button.setAttribute("onclick","removeElement('author','author_div_" + i +"')");
    button.appendChild(document.createTextNode("-"));

    div.appendChild(y);
    div.appendChild(button);

    document.getElementById("author").appendChild(div);
  }
