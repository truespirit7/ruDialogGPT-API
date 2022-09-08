from ruGPT import ruGPTModel
from flask import Flask, request

model = ruGPTModel()
app = Flask(__name__)

@app.route('/', methods=['GET'])
def status():
    return "OK"

@app.route('/', methods=['POST'])
def start():
    request_data = request.get_json()

    context = request_data['context']
    length = int(request_data['length'])
    k = int(request_data['k'])
    p = float(request_data['p'])
    temperature = float(request_data['temperature'])
    rp = float(request_data['rp'])
    nrs = int(request_data['nrs'])
    seed = int(request_data['seed'])

    param ={"length": length,
    "temperature": temperature,
    "repetition_penalty": rp,
    "k": k,
    "p": p,
    "seed": seed,
    "num_return_sequences": nrs}

    model.set_hyper_params(params=param)
    output_str = model.inference(context)

    return output_str

if __name__ == '__main__':
    app.run(host= '10.8.0.5', port=8000, debug=False)