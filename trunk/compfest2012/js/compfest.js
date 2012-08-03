var canvas = document.getElementById("myCanvas");
var context = canvas.getContext("2d");

var images = {};
var sources = {
		lid			: "http://localhost/compfest2012/images/robot/lid.png",
		bodyFront	: "http://localhost/compfest2012/images/robot/bodyFront.png",
		bodyBack	: "http://localhost/compfest2012/images/robot/bodyBack.png",
		rightArm	: "http://localhost/compfest2012/images/robot/rightArm.png",
		rightHand	: "http://localhost/compfest2012/images/robot/rightHand.png",
		leftArm		: "http://localhost/compfest2012/images/robot/leftArm.png",
		leftHand	: "http://localhost/compfest2012/images/robot/leftHand.png",
		shoulder	: "http://localhost/compfest2012/images/robot/shoulder.png",
		face		: "http://localhost/compfest2012/images/robot/face.png",
		crownFrame	: "http://localhost/compfest2012/images/robot/crownFrame.png",
	};
var robotPos_x;
var robotPos_y;
var fps = 60;
var velocity;
	
function loadImages(sources, callback){
	var loadedImages = 0;
	var numImages = 0;
	for (var src in sources) {
		numImages++;
	}
	for (var src in sources) {
		images[src] = new Image();
		images[src].onload = function(){
			if (++loadedImages >= numImages) {		
				drawRobot();
				callback();
			}
		};
		images[src].src = sources[src];
	}
	initialization();
}
function initialization(){
	robotOrg_x = 150;
	robotOrg_y = 200;
	robotPos_x = robotOrg_x;
	robotPos_y = robotOrg_y;
	
	doSetPosition = false;
	
	//is transforming?
	doTransformation = false;
	doTransformCore = false;
	doTransformCrown = false;
	doTransformHead = false;
	doOpenEyes = false;
	doCloseEyes = false;
	doTransformLid = false;
	doTransformLimb1 = false;
	doTransformLimb2 = false;
	doTransformHand = false;
	doTransformFinger = false;

	
	//is already transformed?
	transformedHead = false;
	transformedFace = false;
	transformedCrown = false;
	transformedLid = false;
	transformedLimb = false;
	transformedHand = false;
	
	//head
	headToBodyDist = 0;
	headVelocity = 1;
	
	//crown
	cVelocity = 1;
	leftCrownTL_x 	= robotPos_x-42;
	leftCrownTR_x 	= robotPos_x-28;
	rightCrownTL_x 	= robotPos_x+42;
	rightCrownTR_x 	= robotPos_x+28;
	deltaCrownTL_y 	= -79;
	deltaCrownTR_y 	= -69;
	
	//eyes
	canBlink = false;
	maxEyeHeight = 0.7;
	curEyeHeight = 0.001;
	eyeOpenTime = 0;
	timeBtwBlinks = 5000;
	blinkUpdateTime = 200;
	leftEye_centerX = robotPos_x - 20;
	leftEye_centerY = robotPos_y - 43;
	rightEye_centerX = robotPos_x + 20;
	rightEye_centerY = robotPos_y - 43;
	eyes_radius = 14;
	
	//lid
	lidVelocity = -2;
	lidDefaultHeight = 135;
	lidHeight = lidDefaultHeight;
	
	//limbs
	limb_centerX = robotPos_x + 0;
	limb_centerY = robotPos_y + 18;
	angleCounter = 0;
	limbDist = 0;
	handDist = 0;
	rotSwitch = 1;
	limbDirSwitch = 1;
	handDirSwitch = 1;
	finger_radius1 = 10;
	finger_radius2 = 8;
	fGrowth = 0.01;
	fGrowthSwitch = 1;

	
}
function update(){
	// initialization();
	setInterval(redraw, 1000/fps);
	setInterval(coreBlink, 1000);
	setInterval(updateBlink, blinkUpdateTime);
}
var robotOrg_x;
var robotOrg_y;
var moveDir = 1;
function redraw(){
	context.canvas.width = context.canvas.width;
	if (doTransformation){
	} else {
		if (isClicked2==false){
			isClicked2 = true;
		}
		if (enableIdling){
			
			if (robotPos_y < robotOrg_y){
				moveDir = 1;
			}
			else if (robotPos_y > robotOrg_y+25){
				moveDir = -1;
			}
			velocity = moveDir*0.5;
			robotPos_y += velocity;
		}
	}
	drawRobot();
}

var doTransformCore;
function coreBlink(){
	if (doTransformCore){
		doTransformCore = false;
	} else {
		doTransformCore = true;
	}
}

function drawRobot(){
	drawRC_bodyBack();
	drawRC_head();
	drawRC_crown();
	drawRC_shoulder();
	drawRC_rightArm();
	drawRC_leftArm();
	drawRC_finger();
	drawRC_innard();
	drawRC_core();
	drawRC_bodyFront();
	drawRC_lid();
}
function drawRC_bodyBack(){
	context.drawImage(images.bodyBack, 	robotPos_x + 0 - images.bodyBack.width/2, 	robotPos_y - 3 - images.bodyBack.height/2);
}

/*************************\
|** 	ROBOT's HEAD 	**|
\*************************/
var doTransformHead;
var doTransformFace;
var headToBodyDist;
var headVelocity;
var head_centerX;
var head_centerY;
var head_radius;
var transformedHead;
var transformedFace;
var faceDist = 0;
var fVelocity = 1;
function drawRC_head(){
	head_radius = 43;
	if (doTransformHead){
		if ((headToBodyDist >= 0) && (headToBodyDist <= (125 - 58))){
			headToBodyDist += headVelocity;
		} else {
			doTransformHead = false;
			headVelocity *= -1;
		}
	} else {
		if (headVelocity > 0){
			headToBodyDist = 0;
			if (transformedLid == true){
				doTransformLid = true;
				transformedLid = false;
			}
		} else {
			headToBodyDist = 125 - 58;
			if (transformedHead == false){
				doTransformCrown = true;
				doTransformLimb2 = true;
				transformedHead = true;
			}
		}
	}
	
	head_centerX = robotPos_x + 0;
	head_centerY = robotPos_y - 58 - headToBodyDist;
	
	context.save();
	context.translate(head_centerX, head_centerY);
	context.beginPath();
	context.arc(0, 0, head_radius, 0, 2 * Math.PI, false);
	context.restore();
	context.fillStyle = "#ED3237";
	context.fill();
	context.strokeStyle = "transparent";
	context.stroke();
	
	//face
	context.drawImage(images.face, 	robotPos_x + 0 - images.face.width/2, 	robotPos_y - 46 - headToBodyDist - images.face.height/2);
	
	//eyes
	drawRC_leftEye();
	drawRC_rightEye();
	
	//face-lid
	if (doTransformFace){
		if ((faceDist >= 0) && (faceDist <= 2*head_radius))
			faceDist += fVelocity*2;
		else {
			doTransformFace = false;
			fVelocity *= -1;
		}
	} else {
		if (fVelocity < 0){
			faceDist = 2*head_radius;
			if (transformedFace == false){
				doOpenEyes = true;
				transformedFace = true;
			}
			openEyes();
		} else {
			faceDist = 0;
			if (transformedCrown == true){
				doTransformCrown = true;
				// doTransformLimb2 = true;
				// doTransformFinger = true;
				transformedCrown = false;
			}
		}
	}
	context.save();
        context.translate(head_centerX, head_centerY);
		context.beginPath();
		context.arc(0, 0, head_radius, 0, 2 * Math.PI, false);
        context.clip();

        // draw facelid-right
        context.beginPath();
        context.rect(0 + faceDist, 0 - head_radius, 2*head_radius, 2*head_radius);
        context.fillStyle = "#ED3237";
        context.fill();

        // draw facelid-left
        context.beginPath();
        context.rect(0 - 2*head_radius - faceDist, 0 - head_radius, 2*head_radius, 2*head_radius);
        context.fillStyle = "#ED3237";
        context.fill();
		
	context.restore();

}

/*************************\
|** 	ROBOT's CROWN 	**|
\*************************/
var doTransformCrown;
var leftCrownBL_x;
var leftCrownBR_x;
var leftCrownTL_x;
var leftCrownTR_x;
var rightCrownBL_x;
var rightCrownBR_x;
var rightCrownTL_x;
var rightCrownTR_x;
var crownTL_y;
var crownTR_y;
var deltaCrownTL_y;
var deltaCrownTR_y;
var crownBL_y;
var crownBR_y;
var crownLeftXDist = 42-28;
var crownRightXDist = 28-22;
var crownLeftYDist = 130-80;
var crownRightYDist = 134-70;
var cVelocity;
var transformedCrown;
function drawRC_crown(){
	//crown frame
	context.drawImage(images.crownFrame, 	robotPos_x + 0 - images.crownFrame.width/2, 	robotPos_y - 50 - headToBodyDist - images.crownFrame.height/2);
	//crown horn
	leftCrownBL_x	= robotPos_x-42;
	leftCrownBR_x 	= robotPos_x-28;	
	rightCrownBL_x	= robotPos_x+42;
	rightCrownBR_x 	= robotPos_x+28;
	crownTL_y 		= robotPos_y-headToBodyDist+deltaCrownTL_y;
	crownTR_y 		= robotPos_y-headToBodyDist+deltaCrownTR_y;
	crownBL_y 		= robotPos_y-headToBodyDist-79;
	crownBR_y 		= robotPos_y-headToBodyDist-69;
		//crown horn left
		context.beginPath();
		context.moveTo(leftCrownBL_x, crownBL_y);
		if (doTransformCrown){
			if ((leftCrownTL_x >= leftCrownBL_x)&&(leftCrownTL_x <= (leftCrownBL_x + crownLeftXDist))){
				leftCrownTL_x += (cVelocity*crownLeftXDist)/(5000/fps);
				leftCrownTR_x += (cVelocity*crownRightXDist)/(5000/fps);
				deltaCrownTL_y -= (cVelocity*crownLeftYDist)/(5000/fps);
				deltaCrownTR_y -= (cVelocity*crownRightYDist)/(5000/fps);
			} else {
				doTransformCrown = false;
				cVelocity *= -1;
			}
		} else {
			if (cVelocity < 0){
				leftCrownTL_x = leftCrownBL_x + crownLeftXDist;
				leftCrownTR_x = leftCrownBR_x + crownRightXDist;
				crownTL_y = crownBL_y - crownLeftYDist;
				crownTR_y = crownBR_y - crownRightYDist;
				if (transformedCrown == false){
					doTransformFace = true;
					transformedCrown = true;
				}
			} else {
				leftCrownTL_x = leftCrownBL_x;
				leftCrownTR_x = leftCrownBR_x;
				crownTL_y = crownBL_y;
				crownTR_y = crownBR_y;
				if (transformedHead == true){
					doTransformHead = true;
					doTransformLimb1 = true;
					transformedHead = false;
				}
			}
		}
		context.lineTo(leftCrownTL_x, crownTL_y);
		context.lineTo(leftCrownTR_x, crownTR_y);
		context.lineTo(leftCrownBR_x, crownBR_y);
		context.closePath();
		context.fillStyle = "#A8CF45";
		context.fill();
		context.strokeStyle = "transparent";
		context.stroke();
		
		//crown horn right
		context.beginPath();
		context.moveTo(rightCrownBL_x, crownBL_y);
		if (doTransformCrown){
			if ((rightCrownTL_x <= rightCrownBL_x)&&(rightCrownTL_x >= (rightCrownBL_x - crownLeftXDist))){
				rightCrownTL_x -= (cVelocity*crownLeftXDist)/(5000/fps);
				rightCrownTR_x -= (cVelocity*crownRightXDist)/(5000/fps);
			} 
		} else {
			if (cVelocity < 0){
				rightCrownTL_x = rightCrownBL_x - crownLeftXDist;
				rightCrownTR_x = rightCrownBR_x - crownRightXDist;
				crownTL_y = crownBL_y - crownLeftYDist;
				crownTR_y = crownBR_y - crownRightYDist;
			} else {
				rightCrownTL_x = rightCrownBL_x;
				rightCrownTR_x = rightCrownBR_x;
				crownTL_y = crownBL_y;
				crownTR_y = crownBR_y;
			}
		}
		context.lineTo(rightCrownTL_x, crownTL_y);
		context.lineTo(rightCrownTR_x, crownTR_y);
		context.lineTo(rightCrownBR_x, crownBR_y);
		context.closePath();
		context.fillStyle = "#A8CF45";
		context.fill();
		context.strokeStyle = "transparent";
		context.stroke();
}

/*************************\
|**		ROBOT's EYE		**|
\*************************/
var canBlink;
var doOpenEyes;
var doCloseEyes;
var maxEyeHeight;
var curEyeHeight;
var eyeOpenTime;
var timeBtwBlinks;
var blinkUpdateTime;                    
function updateBlink(){
	if (canBlink){
		eyeOpenTime += blinkUpdateTime;
		if(eyeOpenTime >= timeBtwBlinks){
			blink();
		}
	}
}
function blink() {
	curEyeHeight -= 0.1;
	if (curEyeHeight <= 0) {
		eyeOpenTime = 0;
		curEyeHeight = maxEyeHeight;
	} else {
		setTimeout(blink, 20);
	}
}
function openEyes(){
	if (doOpenEyes){
		curEyeHeight += 0.1;
		if (curEyeHeight >= maxEyeHeight) {
			curEyeHeight = maxEyeHeight;
			doTransformation = false;
			canBlink = true;
			doOpenEyes = false;
		} else {
			setTimeout(openEyes, 20);
		}
	}
}
function closeEyes(){
	if (doCloseEyes){
		curEyeHeight -= 0.1;
		if (curEyeHeight <= 0) {
			curEyeHeight = 0.001;
			canBlink = false;
			eyeOpenTime = 0;
			doCloseEyes = false;
			if (transformedFace == true){
				doTransformFace = true;
				doTransformFinger = true;
				transformedFace = false;
			}
		} else {
			setTimeout(closeEyes, 20);
		}
	}
}
var leftEye_centerX;
var leftEye_centerY;
var eyes_radius;
function drawRC_leftEye(){
	leftEye_centerY = robotPos_y - headToBodyDist - 43;
	context.save();
	context.translate(leftEye_centerX, leftEye_centerY);
	context.rotate(Math.PI/-3);
	context.scale(0.7, 1);
	context.beginPath();
	context.arc(0, 0, eyes_radius, 0, 2 * Math.PI, false);
	context.restore();
	context.fillStyle = "#BDBDBD";
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
	
	context.save();
	context.translate(leftEye_centerX, leftEye_centerY);
	context.rotate(Math.PI/-3);
	context.scale(curEyeHeight, 1);
	context.beginPath();
	context.arc(0, 0, eyes_radius, 0, 2 * Math.PI, false);
	context.restore();
	var grd = context.createRadialGradient(leftEye_centerX, leftEye_centerY, 5, leftEye_centerX, leftEye_centerY, 20);
	grd.addColorStop(0, "#FFFF00");
	grd.addColorStop(1, "#FFBF00");
	context.fillStyle = grd;
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
	
}
var rightEye_centerX;
var rightEye_centerY;
function drawRC_rightEye(){
	rightEye_centerY = robotPos_y - headToBodyDist - 43;
	context.save();
	context.translate(rightEye_centerX, rightEye_centerY);
	context.rotate(Math.PI/3);
	context.scale(0.7, 1);
	context.beginPath();
	context.arc(0, 0, eyes_radius, 0, 2 * Math.PI, false);
	context.restore();
	context.fillStyle = "#BDBDBD";
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
	
	context.save();
	context.translate(rightEye_centerX, rightEye_centerY);
	context.rotate(Math.PI/3);
	context.scale(curEyeHeight, 1);
	context.beginPath();
	context.arc(0, 0, eyes_radius, 0, 2 * Math.PI, false);
	context.restore();
	var grd = context.createRadialGradient(rightEye_centerX, rightEye_centerY, 5, rightEye_centerX, rightEye_centerY, 20);
	grd.addColorStop(0, "#FFFF00");
	grd.addColorStop(1, "#FFBF00");
	context.fillStyle = grd;
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
}
function drawRC_shoulder(){
	context.drawImage(images.shoulder, 	robotPos_x + 0 - images.shoulder.width/2, 	robotPos_y - 41 - images.shoulder.height/2);
}

/*****************************\
|**		ROBOT's LIMBS		**|
\*****************************/
var limb_centerX;
var limb_centerY;
var angleCounter;
var limbDist;
var handDist;
var rotSwitch;
var limbDirSwitch;
var handDirSwitch;
var doTransformLimb1;
var doTransformLimb2;
var doTransformHand;
var transformedLimb;
function drawRC_rightArm(){
	limb_centerX = robotPos_x + 0;
	limb_centerY = robotPos_y + 18;

	context.save();
	context.translate(limb_centerX, limb_centerY);
		if (doTransformLimb1){
			if ((limbDist >= 0)&&(limbDist <= 30)){
				limbDist += limbDirSwitch*1;
			} else {
				limbDirSwitch *= -1;
				doTransformLimb1 = false;
			}
		} else {
			if (limbDirSwitch < 0){
				limbDist = 30;
			} else {
				limbDist = 0;
			}
		}
		
		if (doTransformLimb2){
			if ((angleCounter >= 0)&&(angleCounter <= Math.PI)){
				angleCounter += rotSwitch*0.1;
			} else {
				rotSwitch *= -1;
				doTransformLimb2 = false;
			}
		}
		else {
			if (rotSwitch < 0){
				angleCounter = Math.PI;
				if (transformedLimb == false){
					doTransformHand = true;
					transformedLimb = true;
				}
			} else {
				angleCounter = 0;
			}
		}
	context.rotate(angleCounter);
	context.drawImage(images.rightArm, 	83 + limbDist - images.rightArm.width/2, 17 - images.rightArm.height/2);
	context.restore();
}

var transformedHand;
var doTransformFinger;
function drawRC_rightHand(){
	context.save();
	context.translate(limb_centerX, limb_centerY);
	if (doTransformHand) {
		if ((handDist >= 0)&&(handDist <= 6)){
			handDist += handDirSwitch*1;
		} else{
			handDirSwitch *= -1;
			doTransformHand = false;
		}
	} else {
		if (handDirSwitch < 0){
			handDist = 6;
			if (transformedHand == false){
				doTransformFinger = true;
				transformedHand = true;
			}
		} else {
			handDist = 0;
			if (transformedLimb == true){
				doTransformLimb2 = true;
				transformedLimb = false;
			}
		}
	}
	context.rotate(angleCounter);
	context.drawImage(images.rightHand,  91 + limbDist - handDist - images.rightHand.width/2, -46 - images.rightHand.height/2);
	context.restore();
	
}
function drawRC_leftArm(){
	context.save();
	context.translate(limb_centerX, limb_centerY);
		if (doTransformLimb1){
			if ((limbDistLeft <= 0)&&(limbDistLeft >= -30)){
			limbDistLeft -= limbDirSwitch*1;
			} else {
				limbDirSwitch *= -1;
				doTransformLimb1 = false;
			}
		} else {
			if (limbDirSwitch < 0){
				limbDistLeft = -30;
			} else {
				limbDistLeft = 0;
			}
		}
	context.rotate(-1*angleCounter);
	context.drawImage(images.leftArm, 	-83 - limbDist - images.leftArm.width/2, 	17 - images.leftArm.height/2);
	context.restore();
}
function drawRC_leftHand(){
	context.save();
	context.translate(limb_centerX, limb_centerY);
	context.rotate(-1*angleCounter);
	context.drawImage(images.leftHand, 	-91 - limbDist + handDist - images.leftHand.width/2, 	-46 - images.leftHand.height/2);
	context.restore();
}

var finger_radius1;
var finger_radius2;
var rThumb_centerX;
var lThumb_centerX;
var thumb_centerY;
var finger1_centerY;
var finger2_centerY;
var fGrowth;
var fGrowthSwitch;
function drawRC_finger(){
	if (doTransformFinger){
		if ((fGrowth >= 0.001)&&(fGrowth <= 1)){
			fGrowth += fGrowthSwitch*0.05;
		} else {
			fGrowthSwitch *= -1;
			doTransformFinger = false;
		}
	} else {
		if (fGrowthSwitch < 0){
			fGrowth = 1;
		} else {
			fGrowth = 0.001;
			if (transformedHand == true){
				doTransformHand = true;
				transformedHand = false;
			}
		}
	}
	
	rThumb_centerX = limb_centerX + Math.cos(angleCounter)*(88 + limbDist) + handDist + Math.sin(angleCounter)*46;
	lThumb_centerX = limb_centerX - Math.cos(angleCounter)*(88 + limbDist) - handDist - Math.sin(angleCounter)*46;
	thumb_centerY = limb_centerY + Math.sin(angleCounter)*(88+ limbDist) - Math.cos(angleCounter)*(46+10);
	finger1_centerY = limb_centerY + Math.sin(angleCounter)*(88+ limbDist) - Math.cos(angleCounter)*(46+15);
	finger2_centerY = finger1_centerY + fGrowth*finger_radius1;
	
	context.save();
	context.translate(rThumb_centerX, finger1_centerY);
	context.rotate(Math.PI*(-1/8+(1/2)*Math.sin(angleCounter)));
	context.scale(0.4, fGrowth);
	context.beginPath();
	context.arc(0, 0, finger_radius1, 0, 2 * Math.PI, false);
	context.restore();
	context.fillStyle = "#585858";
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
	
	context.save();
	context.translate(lThumb_centerX, finger1_centerY);
	context.rotate(Math.PI*(1/8-(1/2)*Math.sin(angleCounter)));
	context.scale(0.4, fGrowth);
	context.beginPath();
	context.arc(0, 0, finger_radius1, 0, 2 * Math.PI, false);
	context.restore();
	context.fillStyle = "#585858";
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
	
	context.save();
	context.translate(rThumb_centerX - rotSwitch*5, finger2_centerY);
	context.rotate(Math.PI*(-1/4+(1/2)*Math.sin(angleCounter)));
	context.scale(0.4, fGrowth);
	context.beginPath();
	context.arc(0, 0, finger_radius2, 0, 2 * Math.PI, false);
	context.restore();
	context.fillStyle = "#585858";
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
	
	context.save();
	context.translate(lThumb_centerX + rotSwitch*5, finger2_centerY);
	context.rotate(Math.PI*(1/4-(1/2)*Math.sin(angleCounter)));
	context.scale(0.4, fGrowth);
	context.beginPath();
	context.arc(0, 0, finger_radius2, 0, 2 * Math.PI, false);
	context.restore();
	context.fillStyle = "#585858";
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
		
	drawRC_rightHand();
	drawRC_leftHand();
	
	context.save();
	context.translate(rThumb_centerX + Math.cos(angleCounter)*(-5), thumb_centerY);
	context.rotate(Math.PI*(-1/6+(1/2)*Math.sin(angleCounter)));
	context.scale(0.4, fGrowth);
	context.beginPath();
	context.arc(0, 0, finger_radius1, 0, 2 * Math.PI, false);
	context.restore();
	context.fillStyle = "#585858";
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
	
	context.save();
	context.translate(lThumb_centerX - + Math.cos(angleCounter)*(-5), thumb_centerY);
	context.rotate(Math.PI*(1/6-(1/2)*Math.sin(angleCounter)));
	context.scale(0.4, fGrowth);
	context.beginPath();
	context.arc(0, 0, finger_radius1, 0, 2 * Math.PI, false);
	context.restore();
	context.fillStyle = "#585858";
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
}	

function drawRC_bodyFront(){
	context.drawImage(images.bodyFront, robotPos_x + 0 - images.bodyFront.width/2, 	robotPos_y - 6 - images.bodyFront.height/2);
}
function drawRC_innard(){
	var innard_centerX = robotPos_x + 0;
	var innard_centerY = robotPos_y + 20;
	var innard_radius = 72;
	
	context.save();
	context.translate(innard_centerX, innard_centerY);
	context.beginPath();
	context.arc(0, 0, innard_radius, 0, 2 * Math.PI, false);
	context.restore();
	context.fillStyle = "#FFFFFF";
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
	
	context.beginPath();
	context.moveTo(innard_centerX, innard_centerY + innard_radius);
	context.lineTo(robotPos_x + 0, robotPos_y - 5);
	context.lineWidth = 3;
	context.strokeStyle = "#BDBDBD";
	context.stroke();
}
function drawRC_core(){
	var core_centerX = robotPos_x + 0;
	var core_centerY = robotPos_y - 5;
	var core_radius = 20;
	
	context.save();
	context.translate(core_centerX, core_centerY);
	context.scale(1.25, 1);
	context.beginPath();
	context.arc(0, 0, core_radius + 4, 0, 2 * Math.PI, false);
	context.restore();
	context.fillStyle = "#B43104";
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
	
	context.save();
	context.translate(core_centerX, core_centerY);
	context.scale(1.25, 1);
	context.beginPath();
	context.arc(0, 0, core_radius, 0, 2 * Math.PI, false);
	context.restore();
	var grd = context.createRadialGradient(core_centerX + 8, core_centerY - 8, 10, core_centerX, core_centerY, 40);
	if (doTransformCore){
		grd.addColorStop(0, "#80FF00");
		grd.addColorStop(1, "#088A08");
	} else {
		grd.addColorStop(0, "#31B404");
		grd.addColorStop(1, "#0B610B");
	}
	context.fillStyle = grd;
	context.strokeStyle = "transparent";
	context.fill();
	context.stroke();
}
var doTransformLid;
var transformedLid;
var lidVelocity;
var lidDefaultHeight;
var lidHeight;
var up = false;
function drawRC_lid(){
	if (doTransformLid){
		if ((lidHeight >= 0) && (lidHeight <= lidDefaultHeight)){
			lidHeight += lidVelocity;
			
		} else {
			doTransformLid = false;
			lidVelocity *= -1;
		}
	} else {
		if (lidVelocity > 0) {
			lidHeight = 0;
			if (transformedLid == false){
				doTransformHead = true;
				doTransformLimb1 = true;
				transformedLid = true;
			}
		} else if (lidVelocity < 0){
			lidHeight = lidDefaultHeight;
			// enableIdling = false;
			doTransformation = false;
			
			
		}
	}
	context.drawImage(images.lid, robotPos_x + 0 - images.lid.width/2, robotPos_y + 32 - images.lid.height/2 + (images.lid.height - lidHeight),	images.lid.width, lidHeight);
}

/******************\
|** MAIN SECTION **|
\******************/
var isClicked1 = false;
var isClicked2 = false;
var enableIdling = true; 
// window.onload = function() {
function start1(top){
	if (isClicked1==false){
		isClicked1 = true;		
		loadImages(sources, function(){
			$("#robot").animate(
			{
				top: top,
				opacity: 1,
			},3000,function()
			{
				update();
				transform();
			});
		});
		
	}
}
function start2(){
	if (isClicked2){
		isClicked2 = false;
		transform();
		setTimeout(function()
		{
			$("#robot").animate(
			{
				top: '-500px',
				opacity: 1,
			},3000,function()
			{
				update();
			});
		}
		,4800);
		setTimeout(function()
		{ isClicked1 = false;
		}
		, 3000)
		
	}
	
}
function transform(){
	if ((transformedHead==false) && (transformedCrown==false) && (transformedFace==false) && (transformedLid==false)){
		doTransformation = true;
		doTransformLid = true;
	} else if ((transformedHead==true) && (transformedCrown==true) && (transformedFace==true) && (transformedLid==true)){
		doTransformation = true;
		doCloseEyes = true;
		closeEyes();
	}
}
