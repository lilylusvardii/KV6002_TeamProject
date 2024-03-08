import { useState } from 'react'
 
function SignIn() {
 
    const [signedIn, setSignedIn] = useState(false)
 
    const signIn = () => {
        setSignedIn(true);
    }
    const signOut = () => {
        setSignedIn(false);
    }
 
    return (
      <div className='bg-slate-800 p-2 text-md text-right'>
          { !signedIn && <div>
              <input 
                type="text" 
                placeholder='username' 
                className='p-1 mx-2 bg-slate-100 rounded-md'
              />
              <input 
                type="password" 
                placeholder='password' 
                className='p-1 mx-2 bg-slate-100 rounded-md'
              />
              <input 
                type="submit" 
                value='log In' 
                className='py-1 px-2 mx-2 bg-green-100 hover:bg-green-500 rounded-md'
                onClick={signIn}
              />
          </div>
          }
          { signedIn && <div>
              <input 
                type="submit" 
                value='log Out' 
                className='py-1 px-2 mx-2 bg-green-100 hover:bg-green-500 rounded-md'
                onClick={signOut}
              />
          </div>
          }
      </div>
  )
}
 
export default SignIn