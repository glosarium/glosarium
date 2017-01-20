<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!-- form search -->
            <form v-on:submit.prevent="searchWord" id="dictionary-search-form" action="{{ route('dictionary.national.index') }}" class="form-search-list" method="get">
                <div class="row">
                    <div class="col-sm-10 col-xs-12">
                        <div class="form-group">
                            <label class="color-white">Cari kata</label>
                            <input v-model="forms.keyword" id="keyword" value="" class="form-control" placeholder="Temukan dalam {{ number_format($totalWord, 0, ',', '.') }} pangkalan data...">
                        </div>
                    </div>
                    <div class="col-sm-2 col-xs-12 ">
                        <div class="form-group">
                            <label class="hidden-xs">&nbsp;</label>
                            <button v-bind:class="['btn btn-block btn-theme btn-success', buttons.search.class]">@{{ buttons.search.label }}</button>
                        </div>
                    </div>
                </div>
                <p class="text-right"><a href="#modal-advanced" data-toggle="modal" class="link-white">Pencarian lanjut</a></p>
            </form>
            <!-- form search -->
        </div>
    </div>
    <!-- modal Advanced search -->
    <div class="modal fade" id="modal-advanced" >
        <div class="modal-dialog ">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Advanced Job Search</h4>
                    </div>
                    <div class="modal-body">
                        <h5>Find Jobs</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>With all of these words</label>
                                    <input type="text" class="form-control " name="text" >
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>With the exact phrase</label>
                                    <input type="text" class="form-control " name="text" >
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Show jobs of type</label>
                            <select class="form-control">
                                <option value="all">All job types</option>
                                <option value="fulltime">Full-time</option>
                                <option value="parttime">Part-time</option>
                                <option value="contract">Contract</option>
                                <option value="internship">Internship</option>
                                <option value="temporary">Temporary</option>
                            </select>
                        </div>
                        <div class="white-space-10"></div>
                        <h5>Where and When</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Radius  </label>
                                    <select id="radius" class="form-control">
                                        <option value="0">only in</option>
                                        <option value="5">within 5 kilometers </option>
                                        <option value="10">within 10 kilometers </option>
                                        <option value="15">within 15 kilometers </option>
                                        <option selected="" value="25">within 25 kilometers </option>
                                        <option value="50">within 50 kilometers </option>
                                        <option value="100">within 100 kilometers </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Of  </label>
                                    <input type="text" class="form-control" maxlength="250" value="United States">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Age - Jobs published  </label>
                                    <select class="form-control">
                                        <option value="any">anytime</option>
                                        <option value="15">within 15 days</option>
                                        <option value="7">within 7 days</option>
                                        <option value="3">within 3 days</option>
                                        <option value="1">since yesterday</option>
                                        <option value="last">since my last visit</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Display</label>
                                    <select class="form-control">
                                        <option selected="" value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="30">30</option>
                                        <option value="50">50</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-theme" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success btn-theme">Find Jobs</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end modal forgot password -->
</div>
<!-- end form search area-->
