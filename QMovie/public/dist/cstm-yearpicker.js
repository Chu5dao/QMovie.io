$(document).ready(function() {
    var currentYearPicker = null; // Biến lưu trữ container đang mở
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    var updateYearFilmUrl = $('meta[name="update-year-film-url"]').attr('content');
    function initializeYearPicker($yearPicker) {
        const startYear = 1970;
        const endYear = 2030;
        const yearsPerPage = 8;
        const $yearPickerContainer = $yearPicker.find('.year-picker-container');
        const $yearPickerBody = $yearPicker.find('.year-picker-body');
        let currentYear = $yearPicker.data('current-year'); // Sử dụng giá trị từ data attribute nếu tồn tại
        let currentPage = currentYear ? Math.floor((currentYear - startYear) / yearsPerPage) : 0; // Tính toán trang hiện tại dựa trên currentYear

        function populateYears() {
            $yearPickerBody.empty();
            const start = startYear + currentPage * yearsPerPage;
            const end = Math.min(endYear, start + yearsPerPage - 1);

            // Thêm giá trị "---"
            $yearPickerBody.append(`<div class="year" data-year="">---</div>`);

            for (let year = start; year <= end; year++) {
                $yearPickerBody.append(`<div class="year" data-year="${year}">${year}</div>`);
            }
            highlightCurrentYear();

            const totalPages = Math.ceil((endYear - startYear + 1) / yearsPerPage);

            if (currentPage < totalPages - 1) {
                $yearPicker.find('.next-year').prop('disabled', false);
            } else {
                $yearPicker.find('.next-year').prop('disabled', true);
            }

            if (currentPage > 0) {
                $yearPicker.find('.prev-year').prop('disabled', false);
            } else {
                $yearPicker.find('.prev-year').prop('disabled', true);
            }
        }

        function highlightCurrentYear() {
            $yearPicker.find('.year').removeClass('selected');
            if (currentYear === "") {
                $yearPicker.find('.year[data-year=""]').addClass('selected');
                $yearPicker.find('.current-year').text("---");
            } else {
                $yearPicker.find(`.year[data-year="${currentYear}"]`).addClass('selected');
                $yearPicker.find('.current-year').text(currentYear);
            }
        }

        $yearPicker.off('click', '.prev-year').on('click', '.prev-year', function(event) {
            event.stopPropagation();
            if (currentPage > 0) {
                currentPage--;
                populateYears();
            }
        });

        $yearPicker.off('click', '.next-year').on('click', '.next-year', function(event) {
            event.stopPropagation();
            const totalPages = Math.ceil((endYear - startYear + 1) / yearsPerPage);
            if (currentPage < totalPages - 1) {
                currentPage++;
                populateYears();
            }
        });

        $yearPicker.off('click', '.year').on('click', '.year', function(event) {
            event.stopPropagation();
            currentYear = $(this).data('year');
            highlightCurrentYear();
            $yearPickerContainer.hide();

            var id_film = $yearPicker.attr('class').split(' ')[1].split('-')[2];
            $.ajax({
                url: updateYearFilmUrl,
                method: "POST",
                data: {
                    _token: csrfToken,
                    year: currentYear, 
                    id_film: id_film 
                },
                success: function(response) {
                    if(response.success) {
                        toastr.success(response.message);
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Có lỗi xảy ra: ' + status + ' ' + error);
                    console.log(xhr.responseText);
                    // alert('Có lỗi xảy ra: ' + xhr.responseText);

                }
            });
        });

        $yearPicker.off('click', '.year-picker-header').on('click', '.year-picker-header', function(event) {
            event.stopPropagation();
            // Nếu có year-picker-container đang hiển thị, ẩn nó đi
            if (currentYearPicker && !$yearPickerContainer.is(currentYearPicker)) {
                currentYearPicker.hide();
            }
            $yearPickerContainer.toggle();
            currentYearPicker = $yearPickerContainer;
        });

        populateYears();
    }

    // Gọi initializeYearPicker cho mỗi year-picker
    $('.year-picker').each(function() {
        initializeYearPicker($(this));
    });

    var table = $('#table_phim').DataTable();

    // Đóng year-picker-container khi click ra ngoài
    $(document).on('click', function(event) {
        var $target = $(event.target);
        if (!$target.closest('.year-picker').length) {
            $('.year-picker-container').hide();
            currentYearPicker = null; // Reset biến
        }
    });

    // Khi DataTable vẽ lại, gọi lại initializeYearPicker cho mỗi year-picker
    table.on('draw.dt', function(event) {
        $('.year-picker').each(function() {
            initializeYearPicker($(this));
        });
    });
});
