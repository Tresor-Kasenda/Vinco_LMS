import $ from 'jquery';

$(document).ready(function () {
    $('#status').on('change', function () {
        const status = $("#status option:selected").val()
        $.ajax({
            type: "put",
            url: `{{ route('admins.personnel.active', $employee->key) }}`,
            data: {
                status: status,
                key: `{{ $employee->key }}`,
                _token: '{{ csrf_token() }}'
            },
            dataType : 'json',
            success: function (response) {
                if (response) {
                    Swal.fire(`${response.message}`, "update", "success");
                    console.log(response.message)
                }
            }
        })
    })
})

export  default function (change) {
    let field = document.querySelector('#status')
    field.addEventListener('change', (event) => {
        event.preventDefault();
        event.target
    })
}
