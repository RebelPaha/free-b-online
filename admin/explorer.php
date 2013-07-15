	<script type="text/javascript" src="../ckfinder_v1.js"></script>
	<style type="text/css">

		/* By defining CKFinderFrame, you are able to customize the CKFinder frame style */
		.CKFinderFrame
		{
			border: solid 2px #e3e3c7;
			background-color: #f1f1e3;
		}

	</style>
	<script type="text/javascript">


	</script>
	<p>
		CKFinder may be used in standalone mode inside any page, to create a repository
		manager with ease. You may define a custom JavaScript function to be called when
		an image is selected (double-clicked).</p>
	<div class="description">
		This sample is using the old "V1" integration method.
	</div>
	<div>
		<script type="text/javascript">

			// This is a sample function which is called when a file is selected in CKFinder.
			function ShowFileInfo( fileUrl, data )
			{
				var msg = 'The selected file URL is: ' + fileUrl + '\n\n';
				// Display additional information available in the "data" object.
				// For example, the size of a file (in KB) is available in the data["fileSize"] variable.
				msg += 'File size: ' + data['fileSize'] + 'KB\n';
				msg += 'Last modified: ' + data['fileDate'];

				alert( msg );
			}

			// You can use the "CKFinder" class to render CKFinder in a page:
			var finder = new CKFinder();
			finder.BasePath = '../';	// The path for the installation of CKFinder (default = "/ckfinder/").
			// The default height is 400.
			finder.Height = 600;
			finder.SelectFunction = ShowFileInfo;
			// It is not required to use the "v1" skin.
			finder.Skin = 'v1';
			finder.Create();

			// It can also be done in a single line, calling the "static"
			// Create( basePath, width, height, selectActionFunction ) function:
			// CKFinder.Create( '../', null, null, ShowFileInfo );
			//
			// The "Create" function can also accept an object as the only argument.
			// CKFinder.Create( { BasePath : '../', Skin : 'v1', SelectActionFunction : ShowFileInfo } );

		</script>
	</div>
