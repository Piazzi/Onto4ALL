import React from 'react';
import ReactDOM from 'react-dom';

function Tips(props) {
    return (
        <div class="modal fade" id="tips-menu" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span></button>
                        <h4 style="text-align: center" class="modal-title">{tips}</h4>

                    </div>
                    <div class="modal-body">

                        <div style="margin-bottom: 10px" id="searchBar" class="input-group input-group-sm">
                            <input value="" id="search-tip-input" type="text" class="form-control" placeholder={Search_for_tips}></input>
                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default"><i class="fa fa-search-plus"></i></button>
                            </div>
                        </div>
                        <div id="menu-wrapper">
                            <div class="tab-content">
                                <div id="menu-scroll">
                                    <div id="control-sidebar-theme-demo-options-tab table-search" class="tab-pane active table-search">
                                        @foreach($relations as $ontologyRelation)
                                        <div id="tipSearch" class="box box-default collapsed-box box-solid relation-box">
                                            <div class="box-header with-border">
                                                <h3 class="box-title title">{{$ontologyRelation->name}} <i class="fa fa-fw fa-long-arrow-right"></i></h3>
                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <dl>
                                                    <dt>Definition</dt>
                                                    <dd>{{$ontologyRelation->definition}}</dd>
                                                    @if($ontologyRelation->semi_formal_definition)
                                                    <dt>Semi Formal Definition</dt>
                                                    <dd>{{$ontologyRelation->semi_formal_definition}}</dd>
                                                    @endif
                                                    @if($ontologyRelation->formal_definition)
                                                    <dt>Formal Definition</dt>
                                                    <dd>{{$ontologyRelation->formal_definition}}</dd>
                                                    @endif
                                                    <dt>Domain</dt>
                                                    <dd>{{$ontologyRelation->domain}}</dd>
                                                    <dt>Range</dt>
                                                    <dd>{{$ontologyRelation->range}}</dd>
                                                    <dt>Example Of Usage</dt>
                                                    <dd>{{$ontologyRelation->example_of_usage}}</dd>
                                                    @if($ontologyRelation->imported_from)
                                                    <dt>Imported From</dt>
                                                    <dd>
                                                        <a target="_blank" href="{{$ontologyRelation->imported_from}}">{{$ontologyRelation->imported_from}}</a>
                                                    </dd>
                                                    @endif
                                                    <dt>ID</dt>
                                                    <dd>{{$ontologyRelation->relation_id}}</dd>
                                                    @if(app()->getLocale() =='pt' && $ontologyRelation->label_pt)
                                                    <dt>Label PT</dt>
                                                    <dd>{{$ontologyRelation->label_pt}}</dd>
                                                    @else
                                                    <dt>Label</dt>
                                                    <dd>{{$ontologyRelation->label}}</dd>
                                                    @endif
                                                    @if($ontologyRelation->synonyms)
                                                    <dt>Synonyms</dt>
                                                    <dd>{{$ontologyRelation->synonyms}}</dd>
                                                    @endif
                                                    @if($ontologyRelation->is_defined_by)
                                                    <dt>Is Defined By</dt>
                                                    <dd>{{$ontologyRelation->is_defined_by}}</dd>
                                                    @endif
                                                    @if($ontologyRelation->comments)
                                                    <dt>Editor Note (comments)</dt>
                                                    <dd>{{$ontologyRelation->comments}}</dd>
                                                    @endif
                                                    @if($ontologyRelation->inverse_of)
                                                    <dt>Inverse Of</dt>
                                                    <dd>{{$ontologyRelation->inverse_of}}</dd>
                                                    @endif
                                                    @if($ontologyRelation->subproperty_of)
                                                    <dt>Subproperty Of</dt>
                                                    <dd>{{$ontologyRelation->subproperty_of}}</dd>
                                                    @endif
                                                    @if($ontologyRelation->superproperty_of)
                                                    <dt>Superproperty Of</dt>
                                                    <dd>{{$ontologyRelation->superproperty_of}}</dd>
                                                    @endif
                                                    <dt>Ontology</dt>
                                                    <dd>{{strtoupper($ontologyRelation->ontology)}}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                        @endforeach
                                        @foreach ($classes as $class)
                                        <div id="tipSearch" class="box box-success collapsed-box box-solid">
                                            <div class="box-header with-border">
                                                <h3 class="box-title title">{{$class->name}} <i class="fa fa-fw fa-circle-thin"></i>
                                                </h3>
                                                <div class="box-tools pull-right">
                                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="box-body">
                                                <dl>
                                                    <dt>Definition</dt>
                                                    <dd>{{$class->definition}}</dd>
                                                    @if($class->semi_formal_definition)
                                                    <dt>Semi Formal Definition</dt>
                                                    <dd>{{$class->semi_formal_definition}}</dd>
                                                    @endif
                                                    @if($class->formal_definition)
                                                    <dt>Formal Definition (has_associated_axiom)</dt>
                                                    <dd>{{$class->formal_definition}}</dd>
                                                    @endif
                                                    <dt>ID</dt>
                                                    <dd>{{$class->class_id}}</dd>
                                                    @if($class->subclass)
                                                    <dt>SubClassOf</dt>
                                                    <dd>{{$class->subclass}}</dd>
                                                    @endif
                                                    @if($class->synonyms)
                                                    <dt>Synonyms (has_synonym)</dt>
                                                    <dd>{{$class->synonyms}}</dd>
                                                    @endif
                                                    <dt>Example Of Usage</dt>
                                                    <dd>{{$class->example_of_usage}}</dd>
                                                    @if($class->imported_from)
                                                    <dt>Imported From</dt>
                                                    <dd>
                                                        <a target="_blank" href="{{$class->imported_from}}">{{$class->imported_from}}</a>
                                                    </dd>
                                                    @endif
                                                    @if(app()->getLocale() =='pt' && $ontologyRelation->label_pt)
                                                    <dt>Label PT</dt>
                                                    <dd>{{$ontologyRelation->label_pt}}</dd>
                                                    @else
                                                    <dt>Label</dt>
                                                    <dd>{{$ontologyRelation->label}}</dd>
                                                    @endif
                                                    @if($class->elucidation)
                                                    <dt>Elucidation</dt>
                                                    <dd>{{$class->elucidation}}</dd>
                                                    @endif
                                                    @if($class->is_defined_by)
                                                    <dt>Is Defined By</dt>
                                                    <dd>{{$class->is_defined_by}}</dd>
                                                    @endif
                                                    @if($class->disjoint_with)
                                                    <dt>Disjoint With</dt>
                                                    <dd>{{$class->disjoint_with}}</dd>
                                                    @endif
                                                    @if($class->comments)
                                                    <dt>Editor Note (comments)</dt>
                                                    <dd>{{$class->comments}}</dd>
                                                    @endif
                                                    <dt>Ontology</dt>
                                                    <dd>{{strtoupper($class->ontology)}}</dd>
                                                </dl>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">{Close}</button>
                        {External_Ontology_Databases}:
                        <a href="http://www.ontobee.org/" target="_blank"> OntoBee | </a>
                        <a href="https://bioportal.bioontology.org/" target="_blank"> BioPortal | </a>
                        <a href="https://www.ebi.ac.uk/ols/index" target="_blank"> Ontology Lookup Service (OLS) | </a>
                        <a href="http://swoogle.umbc.edu/2006/" target="_blank"> Swoogle | </a>
                        <a href="http://resources.si.washington.edu/fma_browser1/" target="_blank"> Foundational Model Anatomy
                            Browser </a>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Tips;

if (document.getElementById('tips')) {
    ReactDOM.render(<Tips />, document.getElementById('tips'));
}