import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';
import Select from 'react-select'

class Properties extends React.Component {

    render() {

        const option = [
        ]

        const optionTypes = [
            { value:'', label:'owl:rational' },
            { value:'', label:'owl:real' },
            { value:'', label:'rdf:PlainLiteral' },
            { value:'', label:'rdf:XMLLiteral' },
            { value:'', label:'rdfs:Literal' },
            { value:'', label:'xsd:anyURI' },
            { value:'', label:'xsd:base64Binary' },
            { value:'', label:'xsd:boolean' },
            { value:'', label:'xsd:byte' },
            { value:'', label:'xsd:dateTime' },
            { value:'', label:'xsd:dateTimeStamp' },
            { value:'', label:'xsd:decimal' },
            { value:'', label:'xsd:double' },
            { value:'', label:'xsd:float' },
            { value:'', label:'xsd:hexBinary' },
            { value:'', label:'xsd:int' },
            { value:'', label:'xsd:integer' },
            { value:'', label:'xsd:language' },
            { value:'', label:'xsd:long' },
            { value:'', label:'xsd:Name' },
            { value:'', label:'xsd:NCName' },
            { value:'', label:'xsd:negativeInteger' },
            { value:'', label:'xsd:NMTOKEN' },
            { value:'', label:'xsd:nonNegativeInteger' },
            { value:'', label:'xsd:nonPositiveInteger' },
            { value:'', label:'xsd:normalizedString' },
            { value:'', label:'xsd:positiveInteger' },
            { value:'', label:'xsd:short' },
            { value:'', label:'xsd:string' },
            { value:'', label:'xsd:token' },
            { value:'', label:'xsd:unsignedByte' },
            { value:'', label:'xsd:unsignedInt' },
            { value:'', label:'xsd:unsignedLong' },
            { value:'', label:'xsd:unsignedShort' },
        ]

        return (
            <div className="nav-tabs-custom">
                <ul className="nav nav-tabs">

                    <li><a id="classes-nav" href="#classes-tab" data-toggle="tab" style={{color: '#f39c12'}}><i className="fa fa-fw fa-circle-thin"></i> Classes</a></li>
                    <li><a id="object-properties-nav" href="#object-properties-tab" data-toggle="tab" style={{color: '#3c8dbc'}}><i className="fa fa-fw fa-exchange"></i> Object Properties</a></li>
                    <li><a id="annotations-nav" href="#annotations-tab" data-toggle="tab" style={{color: 'darkred'}}><i className="fa fa-fw fa-book"></i>
                            Annotation Properties</a></li>
                    <li><a id="datatype-properties-nav" href="#datatype-properties-tab" data-toggle="tab" style={{color: '#00a65a'}}><i className="fa fa-fw fa-long-arrow-right"></i> Datatype Properties</a></li>
                    <li><a id="instances-nav" href="#instances-tab" data-toggle="tab" style={{color: 'rebeccapurple'}}><i className="fa fa-fw fa-circle-thin"></i> Instances</a></li>
                    <li style={{visibility: 'hidden', display: 'none'}}><a id="empty-nav" href="#empty-tab" data-toggle="tab" ></a></li>

                </ul>
                <div className="tab-content">
                    <div className="tab-pane active" id="classes-tab">
                        <div className="form-group">
                            <label>SubClassOf</label>
                            <input id="SubClassOf" disabled type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>Equivalence</label>
                            <Select
                                closeMenuOnSelect={false}
                                isMulti
                                options={option}
                                inputId="Equivalence"
                                onChange={() => updatePropertyInput(this.id, $('#'+this.id).val())}
                            />
                        </div>
                        <div className="form-group">
                            <label>Instances</label>
                            <input id="Instances" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>TargetForKey</label>
                            <input id="TargetForKey" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>DisjointWith</label>
                            <Select
                                closeMenuOnSelect={false}
                                isMulti
                                options={option}
                                inputId="DisjointWith"
                                onChange={() => updatePropertyInput(this.id, $('#'+this.id).val())}
                            />
                        </div>
                        <div className="form-group">
                            <label>Constraint</label>
                            <button data-toggle="modal" data-target="#ClassExpressionEditorModal" type="button" className="btn btn-default btn-block"><i className="fa fa-fw fa-folder-open"></i> Class Expression Editor</button>
                        </div>
                    </div>


                    <div className="tab-pane " id="annotations-tab">
                        <div className="form-group">
                            <label>New property</label>
                            <div className="input-group input-group-sm">
                                <input id="new-property-label" type="text" className="form-control"  placeholder="Property name" ></input>
                                <span className="input-group-btn">
                                <button onClick={() => createNewProperty(document.getElementById('new-property-label').value)} type="button" className="btn btn-success btn-flat">Create</button>
                                </span>
                            </div>
                            <label id="created-property-message" style={{visibility: 'hidden', color: '#00a65a'}} className="control-label has-success" htmlFor="inputSuccess"><i className="fa fa-check"></i> Property created! </label>
                        </div>
                        <div className="form-group">
                            <label>IRI</label> <a id="IRI-link" target="_blank" href=""><i title="copy link" className="fa fa-fw fa-link"></i></a>
                            <input id="IRI" type="text" className="form-control" placeholder="" disabled onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>label</label>
                            <input id="label" type="text" className="form-control" placeholder=""disabled onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>comment</label>
                            <input id="comment" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>isDefinedBy</label>
                            <input id="isDefinedBy" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>seeAlso</label>
                            <input id="seeAlso" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>backwardCompartibleWith</label>
                            <input id="backwardCompatibleWith" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>deprecated</label>
                            <input id="deprecated" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>incompatibleWith</label>
                            <input id="incompatibleWith" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>priorVersion</label>
                            <input id="priorVersion" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>versionInfo</label>
                            <input id="versionInfo" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>

                    </div>

                    <div className="tab-pane" id="object-properties-tab">
                        <div className="form-group">
                            <label>domain</label>
                            <input id="domain" disabled type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>range</label>
                            <input id="range" disabled type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>equivalentTo</label>
                            <Select
                                closeMenuOnSelect={false}
                                isMulti
                                options={option}
                                inputId="equivalentTo"
                                onChange={() => updatePropertyInput(this.id, $('#'+this.id).val())}
                            />
                        </div>
                        <div className="form-group">
                            <label>subpropertyOf</label>
                            <Select
                                closeMenuOnSelect={false}
                                options={option}
                                inputId="subpropertyOf"
                                onChange={() => updatePropertyInput(this.id, this.value)}
                            />
                        </div>
                        <div className="form-group">
                            <label>inverseOf</label>
                            <Select
                                closeMenuOnSelect={false}
                                options={option}
                                inputId="inverseOf"
                                onChange={() => updatePropertyInput(this.id, this.value)}
                            />
                        </div>
                        <div className="form-group">
                            <label>disjointWith</label>
                            <Select
                                closeMenuOnSelect={false}
                                isMulti
                                options={option}
                                inputId="disjointWith-relations"
                                onChange={() => updatePropertyInput(this.id, $('#'+this.id).val())}
                            />
                        </div>
                        <div className="form-group">
                            <div className="checkbox">
                                <label>
                                    <input id="functional" type="checkbox" onChange={() => updatePropertyInput(this.id, this.checked)}></input>
                                    Functional
                                </label>
                            </div>

                            <div className="checkbox">
                                <label>
                                    <input id="inverseFunctional" type="checkbox" onChange={() => updatePropertyInput(this.id, this.checked)}></input>
                                    Inverse Functional
                                </label>
                            </div>
                            <div className="checkbox">
                                <label>
                                    <input id="transitive" type="checkbox" onChange={() => updatePropertyInput(this.id, this.checked)}></input>
                                    Transitive
                                </label>
                            </div>
                            <div className="checkbox">
                                <label>
                                    <input id="symetric" type="checkbox" onChange={() => updatePropertyInput(this.id, this.checked)}></input>
                                    Symetric
                                </label>
                            </div>
                            <div className="checkbox">
                                <label>
                                    <input id="asymmetric" type="checkbox" onChange={() => updatePropertyInput(this.id, this.checked)}></input>
                                    Asymmetric
                                </label>
                            </div>
                            <div className="checkbox">
                                <label>
                                    <input id="reflexive" type="checkbox" onChange={() => updatePropertyInput(this.id, this.checked)}></input>
                                    Reflexive
                                </label>
                            </div>
                            <div className="checkbox">
                                <label>
                                    <input id="irreflexive" type="checkbox" onChange={() => updatePropertyInput(this.id, this.checked)}></input>
                                    Irreflexive
                                </label>
                            </div>
                        </div>

                    </div>


                    <div className="tab-pane" id="instances-tab">
                        <div className="form-group">
                            <label>types</label>
                            <Select
                                closeMenuOnSelect={false}
                                options={optionTypes}
                                inputId="types"
                                onChange={() => updatePropertyInput(this.id, this.value)}
                            />
                        </div>
                        <div className="form-group">
                            <label>sameAs</label>
                            <Select
                                closeMenuOnSelect={false}
                                isMulti
                                options={option}
                                inputId="sameAs"
                                onChange={() => updatePropertyInput(this.id, $('#'+this.id).val())}
                            />
                        </div>
                        <div className="form-group">
                            <label>differentAs</label>
                            <Select
                                closeMenuOnSelect={false}
                                isMulti
                                options={option}
                                inputId="differentAs"
                                onChange={() => updatePropertyInput(this.id, $('#'+this.id).val())}
                            />
                        </div>
                        <div className="form-group">
                            <label>objectProperties</label>
                            <input id="objectProperties" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>dataProperties</label>
                            <input id="dataProperties" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>negativeObjectProperties</label>
                            <input id="negativeObjectProperties" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>negativeDataProperties</label>
                            <input id="negativeDataProperties" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput(this.id, this.value)}></input>
                        </div>

                    </div>


                    <div className="tab-pane" id="datatype-properties-tab">
                        <div className="form-group">
                            <label>Value</label>
                            <input id="value-datatype-properties" type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput('value', this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>domain</label>
                            <input id="domain-datatype-properties" disabled type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput('domain', this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>range</label>
                            <input id="range-datatype-properties" disabled type="text" className="form-control" placeholder="" onChange={() => updatePropertyInput('range', this.value)}></input>
                        </div>
                        <div className="form-group">
                            <label>equivalentTo</label>
                            <Select
                                closeMenuOnSelect={false}
                                isMulti
                                options={option}
                                inputId="equivalentTo-datatype-properties"
                                onChange={() => updatePropertyInput(this.id, $('#'+this.id).val())}
                            />
                        </div>
                        <div className="form-group">
                            <label>subpropertyOf</label>
                            <Select
                                closeMenuOnSelect={false}
                                isMulti
                                options={option}
                                inputId="subpropertyOf-datatype-properties"
                                onChange={() => updatePropertyInput(this.id, $('#'+this.id).val())}
                            />
                        </div>
                        <div className="form-group">
                            <label>disjointWith</label>
                            <Select
                                closeMenuOnSelect={false}
                                isMulti
                                options={option}
                                inputId="disjointWith-datatype-properties"
                                onChange={() => updatePropertyInput(this.id, $('#'+this.id).val())}
                            />
                        </div>
                        <div className="form-group">
                            <div className="checkbox">
                                <label>
                                    <input id="functional-datatype-properties" type="checkbox" onChange={() => updatePropertyInput('functional', this.checked)}></input>
                                    Functional
                                </label>
                            </div>
                        </div>
                        <div className="form-group">
                            <label>datatype</label>
                            <Select
                                closeMenuOnSelect={false}
                                options={optionTypes}
                                inputId="datatype"
                                onChange={() => updatePropertyInput(this.id, this.value)}
                            />
                        </div>
                    </div>


                    <div className="tab-pane" id="empty-tab" style={{textAlign: 'center', paddingTop: 100, paddingBottom: 100}}>
                        <i className="fa fa-fw fa-3x fa-hand-pointer-o"></i>
                        <h3>{Select_a_element_in_your_ontology}</h3>
                    </div>
                </div>
            </div>
        );
    }
}

export default Properties;

if (document.getElementById('properties')) {
    ReactDOM.render(<Properties />, document.getElementById('properties'));
}