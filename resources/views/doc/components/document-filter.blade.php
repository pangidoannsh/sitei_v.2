<div class="toggle-filter">
    <label for="toggle" class="toggle-filter-label">
        <span class="fw-bold">Filter</span>
        <button id="toggle" data-toggle="modal" data-target="#filterModal"
            class="custom-select from-control">Pilih</button>
    </label>
</div>

{{-- Desktop --}}
<div class="gap-3 filter" style="height: 0">
    <label>
        <span class="fw-bold">
            Status
        </span>
        <select id="statusFilter" class="custom-select form-control form-control-sm pr-4">
            <option value="" selected>Semua</option>
            <option value="dokumen">Dokumen</option>
            <option value="surat">Surat</option>
            <option value="surat cuti">Surat Cuti</option>
            <option value="sertifikat">Sertifikat</option>
        </select>
    </label>
    <label>
        <span class="fw-bold">
            Kategori
        </span>
        <select id="kategoriFilter" class="custom-select form-control form-control-sm pr-4">
            <option value="" selected>Semua</option>
            @foreach ($kategoris as $kategori)
                <option value="{{ $kategori }}" class="text-capitalize">{{ $kategori }}</option>
            @endforeach
        </select>
    </label>
    <label>
        <span class="fw-bold">
            Semester
        </span>
        <select id="semesterFilter" class="custom-select form-control form-control-sm pr-4">
            <option value="" selected>Semua</option>
            @foreach ($semesters as $semester)
                <option value="{{ $semester->nama }}" class="text-capitalize">{{ $semester->nama }}</option>
            @endforeach
        </select>
    </label>
</div>

{{-- Mobile --}}
<div class="modal fade w-100" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="accepted"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content p-4 rounded-4 d-flex flex-column gap-4">
            <div class="modal-body">
                <div class="modal-title mb-2">
                    Filter
                </div>
                <hr class="mb-3">
                <div class="filter-in-modal">
                    <label>
                        <span class="fw-bold">
                            Status
                        </span>
                        <select id="statusFilterInModal" class="custom-select form-control form-control-sm pr-4">
                            <option value="" selected>Semua</option>
                            <option value="dokumen">Dokumen</option>
                            <option value="surat">Surat</option>
                            <option value="surat cuti">Surat Cuti</option>
                            <option value="sertifikat">Sertifikat</option>
                        </select>
                    </label>
                    <label>
                        <span class="fw-bold">
                            Kategori
                        </span>
                        <select id="kategoriFilterInModal" class="custom-select form-control form-control-sm pr-4">
                            <option value="" selected>Semua</option>
                            @foreach ($kategoris as $kategori)
                                <option value="{{ $kategori }}" class="text-capitalize">{{ $kategori }}</option>
                            @endforeach
                        </select>
                    </label>
                    <label>
                        <span class="fw-bold">
                            Semester
                        </span>
                        <select id="semesterFilterInModal" class="custom-select form-control form-control-sm pr-4">
                            <option value="" selected>Semua</option>
                            @foreach ($semesters as $semester)
                                <option value="{{ $semester->nama }}" class="text-capitalize">{{ $semester->nama }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
