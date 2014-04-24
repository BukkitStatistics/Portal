<div class="row">
    <div class="col-md-12 well">
        <div class="row">
            <div class="col-md-6">
                <fieldset>
                    <label for="portal_title"><strong>Server name</strong></label>
                    <input type="text" name="portal_title" id="portal_title" class="form-control"
                           value="{{ portal_title }}"/>

                    <strong>Time Format</strong>
                    <div class="radio">
                        <label>
                            <input type="radio" name="time_format" id="time_format1"
                                   value="24" {{ showChecked(24, time_format) }}>
                            24 hour format: {{ 'now'|date('H:i - d.m.Y') }}
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="time_format" id="time_format0"
                                   value="12" {{ showChecked(12, time_format) }}>
                            12 hour format: {{ 'now'|date('g:i a - d.m.Y') }}
                        </label>
                    </div>
                </fieldset>
            </div>
            <div class="col-md-6">
                <fieldset>
                    <label for="logo_url"><strong>Logo URL</strong></label>
                    <input type="text" name="logo_url" id="logo_url" class="form-control"
                           value="{{ logo_url }}"/>

                    <label for="timezone"><strong>Timezone</strong></label>
                    <select id="timezone" name="timezone" class="form-control">
                        {% for key, value in times %}
                            {{ printOption(value, key, timezone) }}
                        {% endfor %}
                    </select>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3>Caching</h3>
                <div class="alert alert-info">
                    <p>
                        <span class="label label-info"><strong>Info!</strong></span>
                        Set the time how long the specific module should be stored in the cache.<br>
                        This will drastically increase the performance on large servers.<br>
                        Set the specific caching to <strong>0</strong> to disable it.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <h4>Pages</h4>
                    </div>
                    <div class="col-md-2">
                        <label for="cache_pages[d]">days</label>
                        <input type="text" class="form-control" id="cache_pages[d]" name="cache_pages[d]"
                                value="{{ cache_pages.d }}"/>
                    </div>
                    <div class="col-md-2">
                        <label for="cache_pages[h]">hours</label>
                        <input type="text" class="form-control" id="cache_pages[h]" name="cache_pages[h]"
                               value="{{ cache_pages.h }}"/>
                    </div>
                    <div class="col-md-2">
                        <label for="cache_pages[m]">minutes</label>
                        <input type="text" class="form-control" id="cache_pages[m]" name="cache_pages[m]"
                               value="{{ cache_pages.m }}"/>
                    </div>
                    <div class="col-md-2">
                        <label for="cache_pages[s]">seconds</label>
                        <input type="text" class="form-control" id="cache_pages[s]" name="cache_pages[s]"
                               value="{{ cache_pages.s }}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <h4>Player search</h4>
                    </div>
                    <div class="col-md-2">
                        <label for="cache_search[d]">days</label>
                        <input type="text" class="form-control" id="cache_search[d]" name="cache_search[d]"
                               value="{{ cache_search.d }}"/>
                    </div>
                    <div class="col-md-2">
                        <label for="cache_search[h]">hours</label>
                        <input type="text" class="form-control" id="cache_search[h]" name="cache_search[h]"
                               value="{{ cache_search.h }}"/>
                    </div>
                    <div class="col-md-2">
                        <label for="cache_search[m]">minutes</label>
                        <input type="text" class="form-control" id="cache_search[m]" name="cache_search[m]"
                               value="{{ cache_search.m }}"/>
                    </div>
                    <div class="col-md-2">
                        <label for="cache_search[s]">seconds</label>
                        <input type="text" class="form-control" id="cache_search[s]" name="cache_search[s]"
                               value="{{ cache_search.s }}"/>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-4">
                        <h4>Skins</h4>
                    </div>
                    <div class="col-md-2">
                        <label for="cache_skins[d]">days</label>
                        <input type="text" class="form-control" id="cache_skins[d]" name="cache_skins[d]"
                               value="{{ cache_skins.d }}"/>
                    </div>
                    <div class="col-md-2">
                        <label for="cache_skins[h]">hours</label>
                        <input type="text" class="form-control" id="cache_skins[h]" name="cache_skins[h]"
                               value="{{ cache_skins.h }}"/>
                    </div>
                    <div class="col-md-2">
                        <label for="cache_skins[m]">minutes</label>
                        <input type="text" class="form-control" id="cache_skins[m]" name="cache_skins[m]"
                               value="{{ cache_skins.m }}"/>
                    </div>
                    <div class="col-md-2">
                        <label for="cache_skins[s]">seconds</label>
                        <input type="text" class="form-control" id="cache_skins[s]" name="cache_skins[s]"
                               value="{{ cache_skins.s }}"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="checkbox">
                            <label>
                                <input type="hidden" name="delete_pages" value="0"/>
                                <input type="checkbox" value="1" name="delete_pages" id="delete_pages" />
                                Delete all cached pages.
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="hidden" name="delete_skins" value="0"/>
                                <input type="checkbox" value="1" name="delete_skins" id="delete_skins" />
                                Delete all cached skins.
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>