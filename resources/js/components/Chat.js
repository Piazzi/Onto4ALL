import React from 'react';
import ReactDOM from 'react-dom';
import $ from 'jquery';
import Select from 'react-select'

function Chat(props) {
    return (
        <div className="chat-ontology">
            <div className="box box-solid direct-chat direct-chat-primary collapsed-box" style={{marginBottom: '0px'}}>
                <div className="box-header with-border">
                    <h3 className="box-title"><i className="fa fa-fw fa-wechat"></i> Chat</h3>

                    <div className="box-tools pull-right">
                        <button type="button" className="btn btn-box-tool" data-toggle="tooltip" data-placement="bottom" title={Chat_with_other_collaborators_of_this_ontology_messages_are_saved_and_can_be_read_at_any_time_between_collaborators}><i className="fa fa-question"></i>
                        </button>
                        <button type="button" className="btn btn-box-tool" data-widget="collapse"><i className="fa fa-fw fa-expand"></i>
                        </button>
                    </div>
                </div>
                <div className="box-body" id='chat-ontology'>
                    <div className="direct-chat-msg"></div>
                </div>

                <div className="box-footer">
                    <form action="#" method="post" id='form_send_msg' autoComplete="off">
                        <div className="input-group">
                            <input type="text" name="message" id='message' autoComplete="off" placeholder={Enter_message} className="form-control" disabled></input>
                            <span className="input-group-btn">
                                <a hred='javascript:;' id='send_msg' className="btn btn-primary " disabled>{Send}</a>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    );
}

export default Chat;

if (document.getElementById('chat')) {
    ReactDOM.render(<Chat />, document.getElementById('chat'));
}