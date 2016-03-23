//Store Button Position
var yPosition:Number = 0;

//Declare New XML Object
var myXML:XML = new XML();
//Set Flash to ignore the XML file's white space
myXML.ignoreWhite = true;
//Declare new Array to store the links from the XML file
var links:Array = new Array();
//Declare new Array to store the names from the XML file
var names:Array = new Array();

//Set XML onLoad function
myXML.onLoad = function(){
	//Set varible to store the XML childNodes
	//This allows you to get the number of buttons in the XML file.
	//You'll use this tell flash how many times to loop the for loop.
	var linkname:Array = this.firstChild.childNodes;
	//Set a for loop
	for(i=0;i<linkname.length;i++){
		//Push the button name into the names Array
		names.push(linkname[i].attributes.NAME);
		//Push the button link into the links Array
		links.push(linkname[i].attributes.LINK);
		//Attach the button Movie Clip from the libray give it an instance name and place it on the next highest level
		_root.attachMovie("button","btn"+i,_root.getNextHighestDepth());
		//Set the y position of the buttons
		_root["btn"+i]._y = yPosition;
		//Increace the varible yPosition 15 pixel each time the loop runs to place each button under each other
		yPosition = yPosition + 25
		//Place the button name from names Array into the blackTxt text box
		_root["btn"+(i)].blackTxt.Txt.text = (names[i]);
		//Place the button name from names Array into the whiteTxt text box
		_root["btn"+(i)].whiteTxt.Txt.text = (names[i]);
		//Assign the btnOver function to the button onRollOver state.
		_root["btn"+(i)].onRollOver = btnOver;
		//Assign the btnOut function to the button onRollOut state.
		_root["btn"+(i)].onRollOut = btnOut;
		//Assign the btnRelease function to the button onRelease state.
		_root["btn"+(i)].onRelease = btnRelease;
	}
}
//Load the XML file
myXML.load("links.php");

//Button Over function
function btnOver(){
	//This referse to the current button the mouse is over
	//Go To And Play frame 2 of the current button the mouse is over
	this.gotoAndPlay(2);
	this.Sound("Sound_470");
}
//Button Out function
function btnOut(){
	//Go To And Play frame 16 of the current button the mouse rolls out from
	this.gotoAndPlay(16);
}
//Button Release function
function btnRelease(){
	//Set a varible named currentBtn equal to the instance name of the current button the mouse clicked on
	var currentBtn:String = this._name;
	//Set a varible named currentIndex equal to the varible currentBtn and the characters between 3rd letter and 5th of that string.
	//This will return a number between 0 and the total number of buttons
	var currentIndex:String = currentBtn.substring(3,5);
	//Get the URL from the links Array
	//Use the currentIndex varible as the index number
	getURL(links[currentIndex],"main");
}
