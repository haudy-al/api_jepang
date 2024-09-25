<style>
    .cert {
      border: 15px solid #0072c6;
      border-right: 15px solid #0894fb;
      border-left: 15px solid #0894fb;
      width: 700px;
      font-family: Arial, sans-serif;
      color: #383737;
    }
    
    .crt_title {
      margin-top: 30px;
      font-family: Arial, sans-serif;
      font-size: 40px;
      letter-spacing: 1px;
      color: #0060a9;
    }
  
    .crt_logo img {
      width: 130px;
      height: auto;
      margin: auto;
      padding: 30px;
    }
  
    .colorGreen {
      color: #27ae60;
    }
  
    .crt_user {
      display: inline-block;
      width: 80%;
      padding: 5px 25px;
      margin-bottom: 0px;
      padding-bottom: 0px;
      font-family: Arial, sans-serif;
      font-size: 40px;
      border-bottom: 1px dashed #cecece;
    }
  
    .afterName {
      font-weight: 100;
      color: #383737;
    }
  
    .colorGrey {
      color: grey;
    }
  
    .certSign {
      width: 200px;
    }
  
    @media (max-width: 700px) {
      .cert {
        width: 100%;
      }
    }
  </style>
  <table class="cert" align="center">
    <tr>
      <td align="center" class="crt_logo">
        <img src="" alt="By Haudy">
      </td>
    </tr>
    <tr>
      <td align="center">
        <h1 class="crt_title">Certificate Of Completion</h1>
        <h2>This Certificate is awarded to</h2>
        <h1 class="colorGreen crt_user">{{ $data['name'] }}</h1>
        <h3 class="afterName">{{ $data['nama_ujian'] }}</h3>
        <h3>Score : {{ $data['score'] }} / {{ $data['total_score'] }}</h3>
      </td>
    </tr>
  </table>
  