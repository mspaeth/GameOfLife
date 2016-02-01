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


/////////////////////////////////////////////////////////////
//Returns a cell by their given coords.
/////////////////////////////////////////////////////////////
function getCellByCoords(cells, x, y) {

    for(var k = 0; k<cells.length; k++)
    {
        if(cells[k].getAttribute("x") == x && cells[k].getAttribute("y") == y)
        {
            return cells[k];
        }
    }
    return false;
}

/////////////////////////////////////////////////////////////
//Calculates the amount of neighbours (active cells of a given cell.
/////////////////////////////////////////////////////////////
function calcNeighboursByCell(cellObj) {
    var x = cellObj.xCoord;
    var y = cellObj.yCoord;

    var gameField = document.getElementById("gameField");
    var cells = gameField.getElementsByTagName("td");
    var neighbours = 0;

    for (var k = 0; k<cells.length; k++)
    {
        if((parseInt(cells[k].getAttribute("x"))-1 == x && parseInt(cells[k].getAttribute("y"))-1 == y) && cells[k].getAttribute("active") == "true") neighbours++;
        if((parseInt(cells[k].getAttribute("x")) == x && parseInt(cells[k].getAttribute("y"))-1 == y) && cells[k].getAttribute("active") == "true") neighbours++;
        if((parseInt(cells[k].getAttribute("x"))+1 == x && parseInt(cells[k].getAttribute("y"))-1 == y) && cells[k].getAttribute("active") == "true") neighbours++;
        if((parseInt(cells[k].getAttribute("x"))-1 == x && parseInt(cells[k].getAttribute("y")) == y) && cells[k].getAttribute("active") == "true") neighbours++;
        if((parseInt(cells[k].getAttribute("x"))+1 == x && parseInt(cells[k].getAttribute("y")) == y) && cells[k].getAttribute("active") == "true") neighbours++;
        if((parseInt(cells[k].getAttribute("x"))-1 == x && parseInt(cells[k].getAttribute("y"))+1 == y) && cells[k].getAttribute("active") == "true") neighbours++;
        if((parseInt(cells[k].getAttribute("x")) == x && parseInt(cells[k].getAttribute("y"))+1 == y) && cells[k].getAttribute("active") == "true") neighbours++;
        if((parseInt(cells[k].getAttribute("x"))+1 == x && parseInt(cells[k].getAttribute("y"))+1 == y) && cells[k].getAttribute("active") == "true") neighbours++;
    }

    return neighbours;
}

function Cell(x,y,isActive) {
    this.xCoord = x;
    this.yCoord = y;
    this.isActive = isActive;
}

function setCell(cellObjArray, x, y, isActive) {
    for (var k = 0; k < cellObjArray.length; k++)
    {
        if(cellObjArray[k].xCoord == x && cellObjArray[k].yCoord == y)
        {
            cellObjArray[k].isActive = isActive;
        }
    }
}
window.onload = function() {

    /////////////////////////////////////////////////////////////
    //This part creates the gamefield with cells
    /////////////////////////////////////////////////////////////
    var fieldInfo = getUrlVars();
    var x = fieldInfo['x'];
    var y = fieldInfo['y'];

    var gameField = document.getElementById("gameField");

    var cellsArray = [];
    for(var i = 0; i<x; i++)
    {
        var row = gameField.insertRow(i);
        for(var j = 0; j < y;j++)
        {
            var cell = row.insertCell(j);
            cell.setAttribute('x', i.toString());
            cell.setAttribute('y', j.toString());
            cell.setAttribute('active', 'false');
            cellObj = new Cell(i,j,"false");
            cellsArray.push(cellObj);
        }
    }


    /////////////////////////////////////////////////////////////
    //If a cell is clicked, this part checks if it is active or not,
    //And sets the colour and active state.
    /////////////////////////////////////////////////////////////
    var cells = gameField.getElementsByTagName("td");

    for (var k = 0; k < cells.length; k++)
    {
        cells[k].onclick = function(){
            if(this.getAttribute('active')=='false')
            {
                this.setAttribute('active', 'true');
                this.style.backgroundColor = '#000000';
                setCell(cellsArray, parseInt(this.getAttribute("x")), parseInt(this.getAttribute("y")), "true");
            }
            else
            {
                this.setAttribute('active', 'false');
                this.style.backgroundColor = '#FFFFFF';
                setCell(cellsArray, parseInt(this.getAttribute("x")), parseInt(this.getAttribute("y")), "false");
            }
        };
    }


    /////////////////////////////////////////////////////////////
    //Sets random cells
    /////////////////////////////////////////////////////////////
    document.getElementById("setRandomCells").onclick = function(){

        var cells = gameField.getElementsByTagName("td");

        for (var k = 0; k < cells.length; k++)
        {
            var randNum = Math.random();
            if (randNum <= 0.5)
            {
                cells[k].setAttribute('active', 'true');
                cells[k].style.backgroundColor = '#000000';
            }
        }
    };


    //TODO Runs the game with JS in the given gamefield! Neighbour calculation works, now do the main game logic and copy the object to the field!
    /////////////////////////////////////////////////////////////
    document.getElementById("runGameJs").onclick = function(){
        var askForLoops = prompt("How many rounds you want to play? 0 = infinite till there isn't any life, but this can crash your browser!!");

        var cells = gameField.getElementsByTagName("td");

        if (askForLoops == 0)
        {}
        else
        {
            for (var i=0; i < askForLoops; i++)
            {
                for (var k = 0; k < cellsArray.length; k++)
                {
                    var neighbours = calcNeighboursByCell(cellsArray[k]);
                    console.log("Cell " + cellsArray[k].xCoord + "|" + cellsArray[k].yCoord + " has " + neighbours);
                }
            }
        }
    }
};


