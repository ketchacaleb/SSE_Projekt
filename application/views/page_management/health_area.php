<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="style.css" />
    <div>
        <h1 class="col-md-offset-4"> Welcome to the video call!</h1>
    </div>

    <script src="https://cdn.respoke.io/respoke.min.js"></script>

    <meta id="theme-color" name="theme-color" content="#fff">

    <style>
        button {
            margin: 0 20px 0 0;
            width: 85.9px;
        }
        button#hangupButton {
            margin: 0;
        }
        p.borderBelow {
            margin: 0 0 1.5em 0;
            padding: 0 0 1.5em 0;
        }
        video {
            height: 325px;
            margin: 0 0 20px 0;
            vertical-align: top;
            width: calc(50% - 13px);
        }
        video#localVideo {
            margin: 0 20px 20px 0;
        }
        @media screen and (max-width: 400px) {
            button {
                width: 83px;
            }
            button {
                margin: 0 11px 10px 0;
            }
            video {
                height: 90px;
                margin: 0 0 10px 0;
                width: calc(50% - 7px);
            }
            video#localVideo {
                margin: 0 10px 20px 0;
            }
        }
    </style>

</head>

<body>


</article>

 <div id="container">

     <video id="localVideo" autoplay></video>
     <video id="remoteVideo" autoplay></video>
    <div id="errorMsg"></div>
</div>

<article class="content">
    <script>
        var errorElement = document.querySelector('#errorMsg');
        var video = document.querySelector('video');

        // Put variables in global scope to make them available to the browser console.
        var constraints = window.constraints = {
            audio: true,
            video: true
        };

        function handleSuccess(stream) {
            var videoTracks = stream.getVideoTracks();  // Each available video track is represented by an VideoTrack Object.
            console.log('Got stream with constraints:', constraints);
            console.log('Using video device: ' + videoTracks[0].label);  // The videoTracks property returns a VideoTrackList object.
            stream.oninactive = function() {
                console.log('Stream inactive');
            };
            window.stream = stream; // make variable available to browser console
            video.srcObject = stream;
        }

        function handleError(error) {
            if (error.name === 'ConstraintNotSatisfiedError') {
                errorMsg('The resolution ' + constraints.video.width.exact + 'x' +
                    constraints.video.width.exact + ' px is not supported by your device.');
            } else if (error.name === 'PermissionDeniedError') {
                errorMsg('Permissions have not been granted to use your camera and ' +
                    'microphone, you need to allow the page access to your devices in ' +
                    'order for the demo to work.');
            }
            errorMsg('getUserMedia error: ' + error.name, error);
        }

        function errorMsg(msg, error) {
            errorElement.innerHTML += '<p>' + msg + '</p>';
            if (typeof error !== 'undefined') {
                console.error(error);
            }
        }

        navigator.mediaDevices.getUserMedia(constraints).
        then(handleSuccess).catch(handleError);

    </script>


    <script>
        // create a signalingchanel

       // var signalingChannel = createSignalingChannel();
        var signalingChannel = new SignalingChannel();
        var pc;
        var configuration = { "iceServers": [{ "urls": "http://stiff1992.bplaced.net" }] };

        // run start(true) to initiate a call
        function start(isCaller) {
            pc = new RTCPeerConnection(configuration);

            // send any ice candidates to the other peer
            pc.onicecandidate = function (evt) {
                signalingChannel.send(JSON.stringify({ "candidate": evt.candidate }));
            };

            // once remote stream arrives, show it in the remote video element
            pc.onaddstream = function (evt) {
                remoteView.src = URL.createObjectURL(evt.stream);
            };

            // get the local stream, show it in the local video element and send it
            navigator.getUserMedia({ "audio": true, "video": true }, function (stream) {
                selfView.src = URL.createObjectURL(stream);
                pc.addStream(stream);

                if (isCaller)
                    pc.createOffer(gotDescription);
                else
                    pc.createAnswer(pc.remoteDescription, gotDescription);

                function gotDescription(desc) {
                    pc.setLocalDescription(desc);
                    signalingChannel.send(JSON.stringify({ "sdp": desc }));
                }
            });
        }

        signalingChannel.onmessage = function (evt) {
            if (!pc)
                start(false);

            var signal = JSON.parse(evt.data);
            if (signal.sdp)
                pc.setRemoteDescription(new RTCSessionDescription(signal.sdp));
            else
                pc.addIceCandidate(new RTCIceCandidate(signal.candidate));
        };

    </script>

    <script>

        /* globals webkitRTCPeerConnection */

        var localStream;
        var localPeerConnection;
        var remotePeerConnection;

        var localVideo = document.getElementById('localVideo');
        var remoteVideo = document.getElementById('remoteVideo');

        localVideo.addEventListener('loadedmetadata', function() {
            trace('Local video currentSrc: ' + this.currentSrc +
                ', videoWidth: ' + this.videoWidth +
                'px,  videoHeight: ' + this.videoHeight + 'px');
        });

        remoteVideo.addEventListener('loadedmetadata', function() {
            trace('Remote video currentSrc: ' + this.currentSrc +
                ', videoWidth: ' + this.videoWidth +
                'px,  videoHeight: ' + this.videoHeight + 'px');
        });

        var startButton = document.getElementById('startButton');
        var callButton = document.getElementById('callButton');
        var hangupButton = document.getElementById('hangupButton');
        startButton.disabled = false;
        callButton.disabled = true;
        hangupButton.disabled = true;
        startButton.onclick = start;
        callButton.onclick = call;
        hangupButton.onclick = hangup;

        var total = '';

        function trace(text) {
            total += text;
            console.log((window.performance.now() / 1000).toFixed(3) + ': ' + text);
        }

        function gotStream(stream) {
            trace('Received local stream');
            localVideo.src = URL.createObjectURL(stream);
            localStream = stream;
            callButton.disabled = false;
        }

        function start() {
            trace('Requesting local stream');
            startButton.disabled = true;
            navigator.getUserMedia = navigator.getUserMedia ||
                navigator.webkitGetUserMedia || navigator.mozGetUserMedia;
            navigator.getUserMedia({
                    video: true
                }, gotStream,
                function(error) {
                    trace('navigator.getUserMedia error: ', error);
                });
        }

        function call() {
            callButton.disabled = true;
            hangupButton.disabled = false;
            trace('Starting call');

            if (localStream.getVideoTracks().length > 0) {
                trace('Using video device: ' + localStream.getVideoTracks()[0].label);
            }
            if (localStream.getAudioTracks().length > 0) {
                trace('Using audio device: ' + localStream.getAudioTracks()[0].label);
            }

            var servers = null;

            localPeerConnection =
                new webkitRTCPeerConnection(servers);  // eslint-disable-line new-cap
            trace('Created local peer connection object localPeerConnection');
            localPeerConnection.onicecandidate = gotLocalIceCandidate;

            remotePeerConnection =
                new webkitRTCPeerConnection(servers);  // eslint-disable-line new-cap
            trace('Created remote peer connection object remotePeerConnection');
            remotePeerConnection.onicecandidate = gotRemoteIceCandidate;
            remotePeerConnection.onaddstream = gotRemoteStream;

            localPeerConnection.addStream(localStream);
            trace('Added localStream to localPeerConnection');
            localPeerConnection.createOffer(gotLocalDescription);
        }

        function gotLocalDescription(description) {
            localPeerConnection.setLocalDescription(description);
            trace('Offer from localPeerConnection: \n' + description.sdp);
            remotePeerConnection.setRemoteDescription(description);
            remotePeerConnection.createAnswer(gotRemoteDescription);
        }

        function gotRemoteDescription(description) {
            remotePeerConnection.setLocalDescription(description);
            trace('Answer from remotePeerConnection: \n' + description.sdp);
            localPeerConnection.setRemoteDescription(description);
        }

        function hangup() {
            trace('Ending call');
            localPeerConnection.close();
            remotePeerConnection.close();
            localPeerConnection = null;
            remotePeerConnection = null;
            hangupButton.disabled = true;
            callButton.disabled = false;
        }

        function gotRemoteStream(event) {
            remoteVideo.src = URL.createObjectURL(event.stream);
            trace('Received remote stream');
        }

        function gotLocalIceCandidate(event) {
            if (event.candidate) {
                remotePeerConnection.addIceCandidate(new RTCIceCandidate(event.candidate));
                trace('Local ICE candidate: \n' + event.candidate.candidate);
            }
        }

        function gotRemoteIceCandidate(event) {
            if (event.candidate) {
                localPeerConnection.addIceCandidate(new RTCIceCandidate(event.candidate));
                trace('Remote ICE candidate: \n ' + event.candidate.candidate);
            }
        }
    </script>
</article>

<div>
    <button id="startButton">Start</button>
    <button id="callButton">Call</button>
    <button id="hangupButton">Hang Up</button>
</div>


<script src="../js/lib/ga.js"></script>

</body>
</html>
