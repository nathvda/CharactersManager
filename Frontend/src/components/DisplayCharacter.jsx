import React, { useEffect, useState,} from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom';

const DisplayCharacter = () => {
    const { id } = useParams(); 
    const [data, setData] = useState([]);
    const [char, setChar] = useState();
    const [loading, setLoading] = useState(false);

    function deleteThisMuse(smt){
        axios.delete(`http://localhost:8787/characters/${smt}/delete`)
        .then(res => console.log(res));
    }

    useEffect( () =>   
    {

    setChar(id);

    setLoading(true);

    async function getMuse() {
    
            try {

        const res = await axios.get(`http://localhost:8787/characters/${id}`);
        const idk = await res.data;
    
        setData(idk);
        setLoading(false);
        
            }
            catch (error){
                console.log(error);
            }
    
        
    }

    getMuse();

}, [id]);

if(loading === true) return (
    <>
        <div className="profile">
        <h3 className="loader">Loading</h3>
        </div>
    </>
);

    return (
        <>
        <div className="profile">
        {
        
        data.map((a, index) =><div key={index}>
            <button onClick={(e) => deleteThisMuse(char)}>x</button>
            <h4>{a.nom}</h4>
        <h5>{a.prenom}</h5>
        <p>{a.mbti}</p>
        <p>{a.height} cm</p>
        <p>{a.weight} kg</p>
        <div className="age"><span>age: {a.age}</span></div></div>)           

        }</div> 
        {console.log('unmounting')}
        </>
        
    );
};

export default DisplayCharacter;