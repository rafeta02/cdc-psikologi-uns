<!-- Dropzone Configuration -->
<script>
    // Common Dropzone configuration
    const commonDropzoneConfig = {
        url: '{{ route("frontend.prestasi-mahasiswas.storeMedia") }}',
        maxFilesize: 5, // MB
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 5
        },
        error: function (file, response) {
            let message = $.type(response) === 'string' ? response : response.errors.file;
            
            file.previewElement.classList.add('dz-error');
            let _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]');
            let _results = [];
            
            for (let _i = 0, _len = _ref.length; _i < _len; _i++) {
                let node = _ref[_i];
                _results.push(node.textContent = message);
            }
            
            return _results;
        }
    };

    // Initialize file upload maps
    let uploadedFilesMaps = {
        suratTugas: {},
        sertifikat: {},
        fotoDokumentasi: {},
        buktiSipsmart: {}
    };

    // Surat Tugas Dropzone
    Dropzone.options.suratTugasDropzone = {
        ...commonDropzoneConfig,
        success: function (file, response) {
            $('form').append('<input type="hidden" name="surat_tugas[]" value="' + response.name + '">');
            uploadedFilesMaps.suratTugas[file.name] = response.name;
        },
        removedfile: function (file) {
            file.previewElement.remove();
            let name = '';
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name;
            } else {
                name = uploadedFilesMaps.suratTugas[file.name];
            }
            $('form').find('input[name="surat_tugas[]"][value="' + name + '"]').remove();
        }
    };

    // Sertifikat Dropzone
    Dropzone.options.sertifikatDropzone = {
        ...commonDropzoneConfig,
        success: function (file, response) {
            $('form').append('<input type="hidden" name="sertifikat[]" value="' + response.name + '">');
            uploadedFilesMaps.sertifikat[file.name] = response.name;
        },
        removedfile: function (file) {
            file.previewElement.remove();
            let name = '';
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name;
            } else {
                name = uploadedFilesMaps.sertifikat[file.name];
            }
            $('form').find('input[name="sertifikat[]"][value="' + name + '"]').remove();
        }
    };

    // Foto Dokumentasi Dropzone
    Dropzone.options.fotoDokumentasiDropzone = {
        ...commonDropzoneConfig,
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        params: {
            ...commonDropzoneConfig.params,
            width: 4096,
            height: 4096
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="foto_dokumentasi[]" value="' + response.name + '">');
            uploadedFilesMaps.fotoDokumentasi[file.name] = response.name;
        },
        removedfile: function (file) {
            file.previewElement.remove();
            let name = '';
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name;
            } else {
                name = uploadedFilesMaps.fotoDokumentasi[file.name];
            }
            $('form').find('input[name="foto_dokumentasi[]"][value="' + name + '"]').remove();
        }
    };

    // Surat Tugas Pembimbing Dropzone
    Dropzone.options.suratTugasPembimbingDropzone = {
        ...commonDropzoneConfig,
        maxFiles: 1,
        success: function (file, response) {
            $('form').find('input[name="surat_tugas_pembimbing"]').remove();
            $('form').append('<input type="hidden" name="surat_tugas_pembimbing" value="' + response.name + '">');
        },
        removedfile: function (file) {
            file.previewElement.remove();
            if (file.status !== 'error') {
                $('form').find('input[name="surat_tugas_pembimbing"]').remove();
                this.options.maxFiles = this.options.maxFiles + 1;
            }
        }
    };

    // Bukti SIPSMART Dropzone
    Dropzone.options.buktiSipsmartDropzone = {
        ...commonDropzoneConfig,
        acceptedFiles: '.jpeg,.jpg,.png,.gif',
        params: {
            ...commonDropzoneConfig.params,
            width: 4096,
            height: 4096
        },
        success: function (file, response) {
            $('form').append('<input type="hidden" name="bukti_sipsmart[]" value="' + response.name + '">');
            uploadedFilesMaps.buktiSipsmart[file.name] = response.name;
        },
        removedfile: function (file) {
            file.previewElement.remove();
            let name = '';
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name;
            } else {
                name = uploadedFilesMaps.buktiSipsmart[file.name];
            }
            $('form').find('input[name="bukti_sipsmart[]"][value="' + name + '"]').remove();
        }
    };

    // Add peserta functionality
    document.querySelector('.add-peserta')?.addEventListener('click', function() {
        const pesertaWrapper = document.getElementById('peserta-wrapper');
        const pesertaGroups = pesertaWrapper.querySelectorAll('.peserta-group');
        const newIndex = pesertaGroups.length + 1;
        
        const newPesertaGroup = document.createElement('div');
        newPesertaGroup.className = 'card mb-3 peserta-group';
        newPesertaGroup.innerHTML = `
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Peserta ${newIndex}</h5>
                <button type="button" class="btn btn-danger btn-sm remove-peserta">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nama_peserta_${newIndex}">Nama Peserta</label>
                    <input class="form-control" type="text" name="nama_peserta[]" id="nama_peserta_${newIndex}">
                </div>
                <div class="form-group">
                    <label for="nim_peserta_${newIndex}">NIM Peserta</label>
                    <input class="form-control" type="text" name="nim_peserta[]" id="nim_peserta_${newIndex}">
                </div>
            </div>
        `;
        
        pesertaWrapper.appendChild(newPesertaGroup);
        
        // Add remove functionality to the new group
        newPesertaGroup.querySelector('.remove-peserta').addEventListener('click', function() {
            newPesertaGroup.remove();
            // Update indices of remaining groups
            updatePesertaIndices();
        });
    });

    // Function to update peserta indices
    function updatePesertaIndices() {
        const pesertaGroups = document.querySelectorAll('.peserta-group');
        pesertaGroups.forEach((group, index) => {
            const title = group.querySelector('.card-title');
            if (title) {
                title.textContent = `Peserta ${index + 1}`;
            }
        });
    }

    // Initialize remove buttons for existing peserta groups
    document.querySelectorAll('.remove-peserta').forEach(button => {
        button.addEventListener('click', function() {
            this.closest('.peserta-group').remove();
            updatePesertaIndices();
        });
    });
</script> 