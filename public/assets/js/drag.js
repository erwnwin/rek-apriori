$(function () {
	var $draggedElement = null;
	var $currentCell = null;
	var startX, startY;

	$(".penjadwalan").on('mousedown', function (e) {
		e.preventDefault();

		var $element = $(this);
		var offset = $element.offset();
		var width = $element.outerWidth();
		var height = $element.outerHeight();
		startX = e.pageX - offset.left;
		startY = e.pageY - offset.top;

		// Start dragging
		$draggedElement = $element.clone().addClass('dragging').css({
			'left': e.pageX - startX,
			'top': e.pageY - startY,
			'width': width,
			'height': height
		}).appendTo('body');

		$(document).on('mousemove', function (e) {
			if ($draggedElement) {
				$draggedElement.css({
					'left': e.pageX - startX,
					'top': e.pageY - startY
				});

				var $target = $(document.elementFromPoint(e.pageX, e.pageY)).closest('td.penjadwalan');
				if ($target.length && $target.hasClass('empty-cell')) {
					$target.addClass('placeholder');
				} else {
					if ($currentCell && $currentCell.length) {
						$currentCell.removeClass('placeholder');
					}
				}
				$currentCell = $target;
			}
		});

		$(document).on('mouseup', function (e) {
			if ($draggedElement) {
				if ($currentCell && $currentCell.length && $currentCell.hasClass('empty-cell')) {
					// Swap content
					var tempContent = $currentCell.html();
					$currentCell.html($draggedElement.html());
					$draggedElement.html(tempContent);

					// Get data for AJAX request
					var originalData = $element.data('jadwal');
					var targetData = $currentCell.data('jadwal');

					$.ajax({
						url: 'penjadwalan/update',
						type: 'POST',
						data: {
							original_id: $element.data('id'),
							target_id: $currentCell.data('id'),
							original_data: JSON.stringify(originalData),
							target_data: JSON.stringify(targetData)
						},
						success: function (response) {
							if (response.success) {
								console.log('Update berhasil');
							} else {
								console.log('Update gagal');
								// Restore dragged element if update fails
								$draggedElement.remove();
							}
						},
						error: function () {
							console.log('Terjadi kesalahan saat mengupdate');
							// Restore dragged element if there's an error
							$draggedElement.remove();
						}
					});
				} else {
					// Restore dragged element if not dropped on an empty cell
					$draggedElement.remove();
				}

				$(document).off('mousemove mouseup');
				if ($currentCell && $currentCell.length) {
					$currentCell.removeClass('placeholder');
				}
				$draggedElement.remove();
				$draggedElement = null;
				$currentCell = null;
			}
		});
	});
});
