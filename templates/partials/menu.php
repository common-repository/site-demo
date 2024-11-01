<style>
	#sitedemo-menu {
		background: black;
		font-family: sans-serif;
		font-size: .82rem;
		left: 0;
		opacity: 0;
		padding: .236rem;
		position: fixed;
		top: 0;
		width: 100%;
	}

	#sitedemo-menu:hover {
		opacity: 1;
	}

	#sitedemo-menu a {
		color: white;
	}

	.overlay {
		display: flex;
		position: absolute;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		background: rgba(0, 0, 0, 0.5);
		transition: opacity 200ms;
		visibility: hidden;
		opacity: 0;
	}

	.overlay .cancel {
		position: absolute;
		width: 100%;
		height: 100%;
		cursor: default;
	}

	.overlay:target {
		visibility: visible;
		opacity: 1;
	}

	.popup {
		display: flex;
		flex-direction: column;
		margin: 1rem;
		padding: 1rem;
		background: #fff;
		border: 1px solid #666;
		box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
		width: calc(100% - 4rem);
		position: relative;
	}

	.popup header {
		display: flex;
		justify-content: space-between;
		padding: 1rem;
	}

	.light .popup {
		border-color: #aaa;
		box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
	}

	.popup .close {
		width: 20px;
		height: 20px;
		font-size: 24px;
		font-weight: bold;
		text-decoration: none;
	}

	.popup video {
		overflow: auto;
		width: 100%;
	}

</style>

<div id="sitedemo-menu">
	<a href="<?php echo esc_attr( get_query_var( 'sitedemo_url' ) ) ?>">
		Exit
	</a>
	&nbsp;
	<a href="<?php echo esc_attr( add_query_arg( [ 'sitedemo' => 'browser' ], get_query_var( 'sitedemo_url' ) ) ) ?>">
		Browser mockup
	</a>
	&nbsp;
	<a href="<?php echo esc_attr( add_query_arg( [ 'sitedemo' => 'mobile' ], get_query_var( 'sitedemo_url' ) ) ) ?>">
		Mobile mockup
	</a>
	&nbsp;
	<a href="#" id="start">
		Start Recording
	</a>
	&nbsp;
	<a href="#" id="stop">
		Stop Recording
	</a>

	<a href="#modal-options" id="stop">
		Options
	</a>
</div>

<div id="modal-video" class="overlay">
	<div class="popup">
		<header>
			<b>Right click on the video to save it.</b>
			<a class="close" href="#">&times;</a>
		</header>
		<video autoplay/>
	</div>
</div>

<div id="modal-options" class="overlay">
	<div class="popup">
		<header>
			<b>Options</b>
			<a class="close" href="#">&times;</a>
		</header>
		<div>
			<p>
				<label>
					<input type="checkbox" id="option-sync-url"/>
					Update url while browsing.
				</label>
			</p>
		</div>
	</div>
</div>

<script>
	const start = document.getElementById('start');
	const stop = document.getElementById('stop');
	const video = document.querySelector('video');
	let recorder, stream;

	async function startRecording () {
		stream = await navigator.mediaDevices.getDisplayMedia({
			video: {
				mediaSource: 'tab',
				displaySurface: 'tab'
			},
		});
		recorder = new MediaRecorder(stream);

		const chunks = [];
		recorder.ondataavailable = e => chunks.push(e.data);
		recorder.onstop = e => {
			const completeBlob = new Blob(chunks, { type: chunks[0].type });
			video.src = URL.createObjectURL(completeBlob);
			window.location.hash = 'modal-video';
		};

		recorder.start();
	}

	start.addEventListener('click', () => {
		startRecording();
	});

	stop.addEventListener('click', () => {
		recorder.stop();
		stream.getVideoTracks()[0].stop();
	});
</script>