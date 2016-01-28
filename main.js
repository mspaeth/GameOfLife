/**
 * Created by Max on 28.01.2016.
 */

function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}

window.onload = function() {

    //This part creates the gamiefield with cells
    /////////////////////////////////////////////////////////////
    var fieldInfo = getUrlVars();
    var x = fieldInfo['x'];
    var y = fieldInfo['y'];

    var table = document.getElementById("gameField");

    for(var i = 0; i<x; i++)
    {
        var row = table.insertRow(i);
        for(var j = 0; j < y;j++)
        {
            var cell = row.insertCell(j);
            cell.setAttribute('x', i.toString());
            cell.setAttribute('y', j.toString());
            cell.setAttribute('active', 'false');
        }
    }
    /////////////////////////////////////////////////////////////

    //If a cell is clicked, this part checks if it is active or not,
    //And sets the colour and active state.
    /////////////////////////////////////////////////////////////
    var cells = table.getElementsByTagName("td");

    for (var k = 0; k < cells.length; k++)
    {
        cells[k].onclick = function(){
            if(this.getAttribute('active')=='false')
            {
                this.setAttribute('active', 'true');
                this.style.backgroundColor = '#000000';
            }
            else
            {
                this.setAttribute('active', 'false');
                this.style.backgroundColor = '#FFFFFF';
            }
        };
    }
    /////////////////////////////////////////////////////////////

    //Runs the game with JS in the given gamefield!
    /////////////////////////////////////////////////////////////
    document.getElementById("runGameJs").onclick = function() {
        var askForLoops = prompt("How many rounds you want to play? 0 = infinite till there isn't any life, but this can crash your browser!!");
    }
};


