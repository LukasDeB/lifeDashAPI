import React from 'react';
import FontAwesome from 'react-fontawesome';
 
import { EditorState } from 'draft-js';
import { Editor } from 'react-draft-wysiwyg';
import 'react-draft-wysiwyg/dist/react-draft-wysiwyg.css';

const formStyles = {
  textInputContainer: {
    height: '50px',
    flex: '1',
    display: 'flex',
    flexDirection: 'row',
    animate: 'all 1s',
    padding: '5px 10px',
    backgroundColor: 'transparent',
  },
  textInputContainerEditing: {
    backgroundColor: 'white',
    border: '2px solid #531253',
  },
  editIcon: {
    color: '#DFDFDF',
  },
  
};

export class TextInput extends React.Component {
  constructor(props) {
    super(props);

    this.handleEditClick = this.handleEditClick.bind(this);
    this.handleCloseClick = this.handleCloseClick.bind(this);
    this.handleChange = this.handleChange.bind(this);

    this.state = {
      value: 'value' in this.props ? this.props.value : '',
      editing: 'editing' in this.props ? this.props.editing : false,
      loading: 'loading' in this.props ? this.props.loading : false,
      placeholder: 'placeholder' in this.props ? this.props.placeholder : false,
    };
  }

  handleEditClick() {
    this.setState({ editing: true });
  }

  handleCloseClick() {
    this.setState({ editing: false });
  }

  handleChange(event) {
    this.setState({ editorState: event.target.value });
  }

  render() {
    return this.editing ? (
      <div style={[formStyles.textInput, formStyles.textInputEditing]}>
        <input type="text" value={this.state.value} onChange={this.handleChange} />
        <a onClick={this.handleEditClick}>
          <FontAwesome
            name="edit"
            style={[formStyles.editIcon, { textShadow: '0 1px 0 rgba(0, 0, 0, 0.1)' }]}
          />
        </a>
      </div>
    ) : (
      <div style={formStyles.textInput}>
        <span>{this.state.value}</span>
      </div>
    );
  }
}

export class TextEditor extends React.Component {
  constructor(props) {
    super(props);

    this.onEditorStateChange = this.onEditorStateChange.bind(this);
    this.handleCloseClick = this.handleCloseClick.bind(this);
    this.handleEditClick = this.handleEditClick.bind(this);
    
    this.state = {
      value: 'value' in this.props ? this.props.value : '',
      editing: 'editing' in this.props ? this.props.editing : false,
      loading: 'loading' in this.props ? this.props.loading : false,
      editorState: EditorState.createEmpty(),
    };
  }

  onEditorStateChange(editorState) {
    this.setState({
      editorState,
    });
  };

  handleEditClick() {
    this.setState({ editing: true });
  }

  handleCloseClick() {
    this.setState({ editing: false });
  }

  render() {
    return this.editing ? (
      <div style={{}}>
        <Editor
          editorState={this.state.editorState}
          toolbarClassName="toolbarClassName"
          wrapperClassName="wrapperClassName"
          editorClassName="editorClassName"
          onEditorStateChange={this.onEditorStateChange}
        />
        <a onClick={this.handleEditClick}>
          <FontAwesome
            name="edit"
            style={[formStyles.editIcon, { textShadow: '0 1px 0 rgba(0, 0, 0, 0.1)' }]}
          />
        </a>
      </div>
    ) : (
      <span style={formStyles.textInput}>{this.state.value}</span>
    );
  }
}