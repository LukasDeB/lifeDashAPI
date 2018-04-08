import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import FontAwesome from 'react-fontawesome';
import { EditorState } from 'draft-js';
import { Editor } from 'react-draft-wysiwyg';
import 'react-draft-wysiwyg/dist/react-draft-wysiwyg.css';

// import {
//   TextInput,
//   TextEditor,
// } from './FormComponents';

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
    color: 'black',
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
      editing: true,
      loading: 'loading' in this.props ? this.props.loading : false,
      placeholder: 'placeholder' in this.props ? this.props.placeholder : false,
    };
  }

  handleEditClick(e) {
    e.preventDefault();
    console.log(this)

    this.setState({ editing: true });
  }

  handleCloseClick(e) {
    e.preventDefault();
    console.log(this)
    this.setState({ editing: true });
    console.log(this)
  }

  handleChange(event) {
    this.setState({ editorState: event.target.value });
  }

  render() {
    return !this.editing ? (
      <div style={[formStyles.textInput, formStyles.textInputEditing]}>
        <input type="text" value={this.state.value} onChange={this.handleChange} />
        <a href="#" onClick={this.handleCloseClick}>
          edit
          <FontAwesome
            size="lg"
            name="close"
            style={[formStyles.editIcon, { textShadow: '0 1px 0 rgba(0, 0, 0, 0.1)' }]}
          />
        </a>
      </div>
    ) : (
      <div style={formStyles.textInput}>
        <span style={{ flex: 1 }}>{this.state.value}</span>
        <a href="#" onClick={this.handleEditClick}>
        sdasd
          <FontAwesome
            size="lg"
            name="edit"
            style={[formStyles.editIcon, { textShadow: '0 1px 0 rgba(0, 0, 0, 0.1)' }]}
          />
        </a>
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
      editing: false,
      loading: 'loading' in this.props ? this.props.loading : false,
      editorState: EditorState.createEmpty(),
    };
  }

  onEditorStateChange(editorState) {
    this.setState({
      editorState,
    });
  };

  handleEditClick(e) {
    e.preventDefault();
    console.log('wtf');
    this.setState({ editing: true });
  }

  handleCloseClick(e) {
    e.preventDefault();

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
        <a href="#" onClick={this.handleEditClick}>
          asd
          <FontAwesome
            size="lg"
            name="edit"
            style={[formStyles.editIcon, { textShadow: '0 1px 0 rgba(0, 0, 0, 0.1)' }]}
          />
        </a>
      </div>
    ) : (
      <div style={formStyles.textInput}>
        <span style={{ flex: 1 }}>{this.state.value}</span>
        <a href="#" onClick={this.handleEditClick}>
        asdasd
          <FontAwesome
            size="lg"

            name="edit"
            style={[formStyles.editIcon, { textShadow: '0 1px 0 rgba(0, 0, 0, 0.1)' }]}
          />
        </a>
      </div>
    );
  }
}
const styles = {
  mainContainer: {
    height: '100%',
    width: '100%',
    display: 'flex',
    flexDirection: 'column',
    background: '#191716',
    alignItems: 'center',
  },
  mainTitle: {
    color: '#531253',
    fontSize: '36px',
  },
  questContainer: {
    flex: '0.5',
    background: '#5F5980',
    padding: '50px',
    margin: '20px',
  },
  goalContainer: {
    background: '#420C14',
    padding: '10px',
    margin: '10px 0',
  },
}

const apiUrl = 'http://localhost:8000/api';


const Quest = ({ ...props, data }) => (
  <div key={data.id} {...props} style={styles.questContainer}>
    
      <TextInput value={data.name} />
    {data.description && (
        <TextEditor value={data.description} />
    )}
    <div>
      {data.goals.map(item => <SavingsGoal data={item}  />)}
    </div>
  </div>
);

const SavingsGoal = ({ ...props, data: {...goal, savings_goal: data} }) => (
  <div {...props} style={styles.goalContainer}>
    <h3 style={styles.goalTitle}>{goal.description}</h3>
    <p>{`Amount saved so far: $${data[0].progress} out of $${data[0].targetAmount}`}</p>
    <p>{data[0].reason}</p>
  </div>
);

export default class App extends Component {
  constructor(props) {
    super(props);

    this.state = {
      quests: [],
    }
  }
  
  componentWillMount() {
    axios.get(`${apiUrl}/quests`)
      .then(({ ...res, data: quests }) => {
        this.setState({ quests });
      })
      .catch(error => alert(error));
  }

  render() {
    return (
      <div style={styles.mainContainer}>
        <h1 style={styles.mainTitle}>Active Quests</h1>
        <div style={styles.questsContainer}>
          {this.state.quests.map(item => (
            <Quest key={item.id} data={item} />
          ))}
        </div>
      </div>
    );
  }
}

