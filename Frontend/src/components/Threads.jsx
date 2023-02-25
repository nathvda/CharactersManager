import React, { useEffect, useState } from 'react';
import axios from 'axios';

const Threads = () => {

    const [threads, setThreads] = useState([]);

    function updateDate(thread,index){
        console.log(thread);
        let stat;
        if (threads[index].todo == 1){
                stat = 0;
        } else{
                stat = 1;  
        }

        axios.put(`http://localhost:8787/threads/${thread}/update`, {
            status : stat
        });
    }

    useEffect(() => 
    async function getThreads(){

        try {
            const res = await axios.get('http://localhost:8787/threads');
            const data = await res.data;

            setThreads(data);

        } catch (error) {
            console.log(error);
        }

    }
    , [] );

    return (
        <>
            <h2>Threads</h2> 
            <table>
                <thead>
                <tr>
                    <th>Titre</th>
                    <th>Character</th>
                    </tr>
                </thead>
                <tbody>
            {
            threads.map((a,index) => <tr key={index}>
                <td className={(a.todo === 1) ? "yourturn" : "notyourturn"}><a href={a.url} target="_blank">WWW</a> {a.title}</td>
                <td>{a.char_name}</td>
                <td><button onClick={(e) => updateDate(a.topic_id, index)}>{(a.todo === 1) ? "Mark as replied" : "Mark as to do"}</button></td>
            </tr>
            )
            }</tbody>
            </table>
        </>
    );
};

export default Threads;