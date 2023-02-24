import React, { useEffect, useState } from 'react';
import axios from 'axios';

const NewThread = () => {

    const [title, setTitle] = useState([]);
    const [url, setUrl] = useState([]);
    const [chosenMuse, setChosenMuse] = useState([]);
    const [muses, setMuses] = useState([]);
    const [start, setStart] = useState([]);


    async function sendForm(){

        try { 

            await axios({
                method: 'POST',
                url: 'http://localhost:8787/threads/add',
                data: {
                    title: title,
                    url: url,
                    personnage_id: chosenMuse,
                    started: start
                }

            })
            .then(res => console.log(res))

        } catch (error){

            console.log(error);

        }
    }

    useEffect(() => 
    async function getThreads(){

        try {
            const res = await axios.get('http://localhost:8787/characters');
            const data = await res.data;

            setMuses(data);

        } catch (error) {
            console.log(error);
        }

    }
    , [] );

    return (
        <>
            <h2>Add a new thread</h2>
            <form method="post" onSubmit={(e) => e.preventDefault()}>
            <label htmlFor="title">Title of the thread</label>
            <input name="title" type="text" onChange={(e) => setTitle(e.target.value)}/>
            <label htmlFor="url">Url</label>
            <input name="url" type="text" onChange={(e) => setUrl(e.target.value)}/>
            <label htmlFor="character">muse name</label>
            <select onChange={(e) => setChosenMuse(e.target.value)}>
                <option value="0">Select a muse</option>
                {
                muses.map((a,index) => <option key={index} value={a.id}>{a.nom} {a.prenom}</option>
                )
            }
            </select>
            <label htmlFor="started">Start date</label>
            <input type="date" id="started" name="started" onChange={(e) => setStart(e.target.value)}/>
            <button type="submit" onClick={(e) => sendForm()}>Create character</button>
            </form>  
        </>
    );
};

export default NewThread;