<div class="col-12 col-md-6 col-lg-4 mb-3">
    <div class="class-card" data-href="{{ auth()->user()->user_type === 'teacher' ? route('bulletins', ['classId' => $class->id]) : route('studentbulletins', ['classId' => $class->id]) }}" style="cursor: pointer;">
        <div class="class-card-image" style="background-image: url('{{ asset('storage/' . $class->image_path) }}');"></div>
        <div class="class-card-info">
            <div class="d-flex justify-content-center align-items-center position-relative">
                <h3 class="class-name text-center">{{ $class->class_name }}</h3>
                <div class="dropdown position-absolute" style="right: 0;">
                    @if(auth()->user()->user_type === 'teacher')
                    <button class="btn btn-link p-0 m-0" type="button" id="dropdownMenuButton{{ $class->id }}" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('img/pencil.png') }}" alt="Edit" width="24" height="24">
                    </button>
                    @endif
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $class->id }}">
                        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#editClassModal{{ $class->id }}">Edit</a></li>
                        <li><a class="dropdown-item text-danger" href="#" onclick="showDeleteConfirmation({{ $class->id }})">Delete</a></li>
                    </ul>
                </div>
            </div>

            <!-- Class Info -->
            <div class="class-info-compact">
                <p class="class-name"> {{ $class->name }}</p>

                <p><span class="label">Subject:</span> {{ $class->subject }}</p>
                <p><span class="label">Section:</span> {{ $class->section }}</p>
                <p><span class="label">Schedule:</span> {{ $class->schedule }}</p>
                <p><span class="label">Room:</span> {{ $class->room }}</p>
            </div>
    </div>

    <!-- Modal for Editing Class Details -->
    <div class="modal fade" id="editClassModal{{ $class->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editClassModalLabel{{ $class->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editClassModalLabel{{ $class->id }}">Edit Class</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Multi-step Form for Editing Class Details -->
                    <form id="editClassForm{{ $class->id }}" action="{{ route('classes.update', $class->id) }}" method="POST" enctype="multipart/form-data" autocomplete="off">
                        @csrf
                        @method('PUT')
                        <div class="modal-form-sections">
                            <!-- Section 1: Class Name, Section, and Image Upload -->
                            <div id="edit-section-1-{{ $class->id }}">
                                <div class="form-section">
                                    <div class="mb-3">
                                        <label for="editClassName{{ $class->id }}" class="form-label">Class Name</label>
                                        <input type="text" class="form-control" id="editClassName{{ $class->id }}" name="class_name" value="{{ $class->class_name }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editSection{{ $class->id }}" class="form-label">Section</label>
                                        <input type="text" class="form-control" id="editSection{{ $class->id }}" name="section" value="{{ $class->section }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editImage{{ $class->id }}" class="form-label">Class Image</label>
                                        <input type="file" class="form-control" id="editImage{{ $class->id }}" name="image" accept="image/*">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-primary" id="edit-next-to-2-{{ $class->id }}">Next</button>
                                <div id="edit-error-message-1-{{ $class->id }}" class="text-danger mt-2" style="display: none;">Please fill in all required fields.</div>
                            </div>
                            <!-- Section 2: Subject and Room -->
                            <div id="edit-section-2-{{ $class->id }}" style="display: none;">
                                <div class="form-section">
                                    <div class="mb-3">
                                        <label for="editSubject{{ $class->id }}" class="form-label">Subject</label>
                                        <input type="text" class="form-control" id="editSubject{{ $class->id }}" name="subject" value="{{ $class->subject }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="editRoom{{ $class->id }}" class="form-label">Room</label>
                                        <input type="text" class="form-control" id="editRoom{{ $class->id }}" name="room" value="{{ $class->room }}">
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary" id="edit-back-to-1-{{ $class->id }}">Back</button>
                                <button type="button" class="btn btn-primary" id="edit-next-to-3-{{ $class->id }}">Next</button>
                                <div id="edit-error-message-2-{{ $class->id }}" class="text-danger mt-2" style="display: none;">Please fill in all required fields.</div>
                            </div>
                            <!-- Section 3: Schedule -->
                            <div id="edit-section-3-{{ $class->id }}" style="display: none;">
                                <div class="mb-3">
                                    <label for="editSchedule{{ $class->id }}" class="form-label">Schedule</label>
                                    <input type="text" class="form-control" id="editSchedule{{ $class->id }}" name="schedule" value="{{ $class->schedule }}">
                                </div>
                                <button type="button" class="btn btn-secondary" id="edit-back-to-2-{{ $class->id }}">Back</button>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                <div id="edit-error-message-3-{{ $class->id }}" class="text-danger mt-2" style="display: none;">Please fill in all required fields.</div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Form for Deleting a Class -->
    <form id="delete-form-{{ $class->id }}" action="{{ route('classes.destroy', $class->id) }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
</div>

<!-- Confirmation Modal -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this class?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmDeleteButton" class="btn btn-danger" onclick="confirmDelete()">Delete</button>
            </div>
        </div>
    </div>
</div>









