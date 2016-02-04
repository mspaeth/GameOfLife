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
        if (cells[k].getAttribute("active") == "true")
        {
            if((parseInt(cells[k].getAttribute("x"))-1 == x && parseInt(cells[k].getAttribute("y"))-1 == y)) neighbours++;
            if((parseInt(cells[k].getAttribute("x")) == x && parseInt(cells[k].getAttribute("y"))-1 == y)) neighbours++;
            if((parseInt(cells[k].getAttribute("x"))+1 == x && parseInt(cells[k].getAttribute("y"))-1 == y)) neighbours++;
            if((parseInt(cells[k].getAttribute("x"))-1 == x && parseInt(cells[k].getAttribute("y")) == y)) neighbours++;
            if((parseInt(cells[k].getAttribute("x"))+1 == x && parseInt(cells[k].getAttribute("y")) == y)) neighbours++;
            if((parseInt(cells[k].getAttribute("x"))-1 == x && parseInt(cells[k].getAttribute("y"))+1 == y)) neighbours++;
            if((parseInt(cells[k].getAttribute("x")) == x && parseInt(cells[k].getAttribute("y"))+1 == y)) neighbours++;
            if((parseInt(cells[k].getAttribute("x"))+1 == x && parseInt(cells[k].getAttribute("y"))+1 == y)) neighbours++;
        }
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
    for(var i = 0; i<y; i++)
    {
        var row = gameField.insertRow(i);
        for(var j = 0; j < x;j++)
        {
            var cell = row.insertCell(j);
            cell.setAttribute('x', j.toString());
            cell.setAttribute('y', i.toString());
            cell.setAttribute('active', 'false');
            cell.style.opacity = 1.0;
            cell.style.backgroundColor = '#FFFFFF';
            cellObj = new Cell(j,i,"false");
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
                this.style.backgroundColor = '#261283';
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
              //  cells[k].style.backgroundColor = randomColor();
                cells[k].style.backgroundColor = '#261283';
            }
        }
    };

    /////////////////////////////////////////////////////////////
    //Runs the game
    /////////////////////////////////////////////////////////////
    document.getElementById("runGameJs").onclick = function(){

        var cells = gameField.getElementsByTagName("td");

        var interval = setInterval(function(){
                    for (var k = 0; k < cellsArray.length; k++)
                    {
                        var tempFieldArray = JSON.parse(JSON.stringify(cellsArray));
                        var neighbours = calcNeighboursByCell(tempFieldArray[k]);
                        console.log("Round "+ i);
                        console.log("Cell "+ tempFieldArray[k].xCoord + "|" + tempFieldArray[k].yCoord + "has " + neighbours + " neighbours! IsActive=" +tempFieldArray[k].isActive);

                        if (tempFieldArray[k].isActive == "true")
                        {
                            if (neighbours < 2 || neighbours > 3)
                            {
                                cellsArray[k].isActive = "false";
                                console.log("Cell will die!");
                            }
                        }
                        else if (tempFieldArray[k].isActive == "false")
                        {
                            if (neighbours == 3)
                            {
                                cellsArray[k].isActive = "true";
                                console.log("Cell will live!");
                            }
                        }

                        tempFieldArray.length = 0
                    }
                    console.log("----------------------------------------");

                    for (var d = 0; d < cellsArray.length; d++)
                    {
                        if (cellsArray[d].isActive == "true")
                        {
                            if (cells[d].getAttribute("active") == "true")
                            {
                                    cells[d].style.opacity = cells[d].style.opacity-0.1;
                            }
                            else if (cells[d].getAttribute("active") == "false")
                            {
                                cells[d].setAttribute("active", cellsArray[d].isActive);
                                cells[d].style.backgroundColor = '#261283';
                                cells[d].style.opacity = 1.0;
                            }
                        }
                        else if (cellsArray[d].isActive == "false")
                        {
                            cells[d].setAttribute("active", cellsArray[d].isActive);
                            cells[d].style.backgroundColor = "#FFFFFF";
                            cells[d].style.opacity = 1.0;
                        }
                    }

                    document.getElementById("stopGameJs").onclick = function(){
                        clearInterval(interval);
                    }

        },1000);

    }


};


