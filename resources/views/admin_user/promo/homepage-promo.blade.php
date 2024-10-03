<div class="tab-pane fade active show" id="list-messages" role="tabpanel" aria-labelledby="list-messages-list">
    <div class="card border">
        <div class="card-body">
            <form action="{{ route('admin_user.homepage-promo-section') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <h5>Promo one</h5>
                <div class="form-group">
                    <label for="">Status</label>
                    <br>
                    <label class="custom-switch mt-2">
                        <input type="checkbox"
                            {{ @$homepage_section_promo->promo_one->status == 1 ? 'checked' : '' }}
                            name="promo_one_status" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
                <div class="form-group">
                    <img src="{{ asset(@$homepage_section_promo->promo_one->promo_image) }}" alt=""
                        width="150px">
                </div>
                <div class="form-group">
                    <label>Promo Image</label>
                    <input type="file" class="form-control" name="promo_one_image" value="">
                    <input type="hidden" class="form-control" name="promo_one_old_image"
                        value="{{ @$homepage_section_promo->promo_one->promo_image }}">
                </div>
                <div class="form-group">
                    <label>Promo url</label>
                    <input type="text" class="form-control" name="promo_one_url"
                        value="{{ @$homepage_section_promo->promo_one->promo_url }}">
                </div>
                <hr>
                <h5>Promo two</h5>
                <div class="form-group">
                    <label for="">Status</label>
                    <br>
                    <label class="custom-switch mt-2">
                        <input type="checkbox"
                            {{ @$homepage_section_promo->promo_two->status == 1 ? 'checked' : '' }}
                            name="promo_two_status" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
                <div class="form-group">
                    <img src="{{ asset(@$homepage_section_promo->promo_two->promo_image) }}" alt=""
                        width="150px">
                </div>
                <div class="form-group">
                    <label>Promo Image</label>
                    <input type="file" class="form-control" name="promo_two_image" value="">
                    <input type="hidden" class="form-control" name="promo_two_old_image"
                        value="{{ @$homepage_section_promo->promo_two->promo_image }}">
                </div>
                <div class="form-group">
                    <label>Promo url</label>
                    <input type="text" class="form-control" name="promo_two_url"
                        value="{{ @$homepage_section_promo->promo_two->promo_url }}">
                </div>
                <h5>Promo Three</h5>
                <div class="form-group">
                    <label for="">Status</label>
                    <br>
                    <label class="custom-switch mt-2">
                        <input type="checkbox"
                            {{ @$homepage_section_promo->promo_three->status == 1 ? 'checked' : '' }}
                            name="promo_three_status" class="custom-switch-input">
                        <span class="custom-switch-indicator"></span>
                    </label>
                </div>
                <div class="form-group">
                    <img src="{{ asset(@$homepage_section_promo->promo_three->promo_image) }}" alt=""
                        width="150px">
                </div>
                <div class="form-group">
                    <label>Promo Image</label>
                    <input type="file" class="form-control" name="promo_three_image" value="">
                    <input type="hidden" class="form-control" name="promo_three_old_image"
                        value="{{ @$homepage_section_promo->promo_three->promo_image }}">
                </div>
                <div class="form-group">
                    <label>Promo url</label>
                    <input type="text" class="form-control" name="promo_three_url"
                        value="{{ @$homepage_section_promo->promo_three->promo_url }}">
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
